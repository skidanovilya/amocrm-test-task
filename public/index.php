<?php 

use App\Helpers\Renderer;
use AmoCRM\Models\LeadModel;

require "../app/bootstrap.php";

$data = [];

if ($_SERVER["REQUEST_METHOD"] === "POST"
    && $_POST["submit"]) {

    if (isset($_SESSION["ACCESS_TOKEN"])) {        
        $token = $client->getOAuthClient()->getAccessTokenByRefreshToken($_SESSION["ACCESS_TOKEN"]);
    } else {
        $token = $client->getOAuthClient()->getAccessTokenByCode($_POST["AUTHORIZATION_CODE"]);
    }

    $_SESSION["ACCESS_TOKEN"] = $token;
}

Renderer::render("index", $data);

?>
