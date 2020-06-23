<?php 

use App\Helpers\Renderer;
use App\Helpers\Request;
use App\Config\Config;

require "../app/bootstrap.php";

$config = new Config();

$request = new Request();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    if (!isset($_SESSION["refresh_token"]) && isset($_POST["AUTHORIZATION_CODE"])) {
        $auth_code = $_POST["AUTHORIZATION_CODE"];
    
        // Получаем refresh_token
        $request->prepare("/oauth2/access_token", [
            "client_id" => $config->CLIENT_ID,
            "client_secret" => $config->CLIENT_SECRET,
            "grant_type" => "authorization_code",
            "code" => $auth_code,
            "redirect_uri" => $config->CLIENT_REDIRECT_URI
        ]);
        $refresh_token = $request->run()->refresh_token;
    
        $_SESSION["refresh_token"] = $refresh_token;
    }
    
    // По полученному refresh_token получаем access_token
    $request->prepare("/oauth2/access_token", [
        "client_id" => $config->CLIENT_ID,
        "client_secret" => $config->CLIENT_SECRET,
        "grant_type" => "refresh_token",
        "refresh_token" => $_SESSION["refresh_token"],
        "redirect_uri" => $config->CLIENT_REDIRECT_URI
    ])->access_token;
    $access_token = $request->run()->access_token;
    
    
    // Схема кастомных полей

    $custom_fields_schema = [
        "Oferta" => "checkbox", 
        "utm_source" => "text",
        "utm_medium" => "text",
        "utm_campaign" => "text",
        "utm_term" => "text", 
        "utm_content" => "text",
        "MailAgree" => "checkbox",
        "Company" => "text",
        "Имя контакта" => "text",
        "Телефон" => "text",
        "FormID" => "text"
    ];
    
    // Получаем список существующих кастомных полей
    $request->prepare("/api/v4/leads/custom_fields", [], $access_token, "GET");
    $custom_fields = $request->run();
    
    // Список ID кастомных полей
    $custom_fields_ids = [];
    
    // Ищем среди всех существующих кастомных полей поля из схемы
    // Если поле уже существует в AmoCRM, удаляем его из схемы и сохраняем ID в список
    foreach($custom_fields->_embedded->custom_fields as $field) {
        if (in_array($field->name, array_keys($custom_fields_schema))) {
            $custom_fields_ids[$field->name] = $field->id;
            unset($custom_fields_schema[$field->name]);
        }
    }
    
    // Создаем несуществующие в AmoCRM поля
    foreach ($custom_fields_schema as $name => $type) {
        $field = [
            "type" => $type,
            "name" => $name,
        ];
    
        $request->prepare("/api/v4/leads/custom_fields", [$field], $access_token);
        $response = $request->run();
        
        $id = $response->_embedded->custom_fields[0]->id;
    
        $custom_fields_ids[$name] = $id;
    }

    $custom_fields_values = [];



    // Получаем данные к отправке из POST и GET
    // Фильтруем данные с формы, которых нет в схеме 
    
    foreach(array_merge($_POST, $_GET) as $k => $v) {
        $k = str_replace("-", " ", $k);
        if (in_array($k, array_keys($custom_fields_ids))) {            
            if (in_array($k, ["Oferta", "MailAgree"])) {
                $v = strtolower($v) == "on";
            } 

            array_push($custom_fields_values, [
                "field_id" => $custom_fields_ids[$k],
                "values" => [
                    ["value" => $v]
                ]
            ]);
        }
    }
    
    $lead = [
        "name" => $_POST["name"],
        "custom_fields_values" => $custom_fields_values
    ];

    $request->prepare("/api/v4/leads", [$lead], $access_token);

    if($request->run()) {
        echo "Сделка добавлена!";
    }   
}
Renderer::render("index", $data);