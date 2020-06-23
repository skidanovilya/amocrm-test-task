<?php 

namespace App\Helpers;

use App\Config\Config;
use App\Exceptions\ApiRequestException;

class Request {
    private $curl;

    public function __construct($method = NULL, $data = []) {
        if ($method) {
            $this->prepare($method, $data);
        }
    }

    public function run() {
        $response_body = curl_exec($this->curl);
        $response_code = intval(curl_getinfo($this->curl, CURLINFO_HTTP_CODE));

        curl_close($this->curl);
    
        if ($response_code < 200 || $response_code > 204) {
            throw new ApiRequestException("Response with error code: " . $response_code);
        }
    
        return json_decode($response_body);
    }

    public function prepare($method, $data = [], $access_token = NULL, $type = "POST") {  
        $config = new Config();
        
        $method = ltrim($method, "/");
    
        $url = "https://" . $config->CLIENT_SUBDOMAIN . ".amocrm.ru/" . $method;
    
        $headers = [
            'Content-Type:application/json'
        ];

        if ($access_token) {
            array_push($headers, "Authorization: Bearer " . $access_token);
        }

        $options = [
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_USERAGENT => "amoCRM-oAuth-client/1.0",
            CURLOPT_URL => $url,
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_HEADER => false,
            CURLOPT_CUSTOMREQUEST => $type,
            CURLOPT_SSL_VERIFYPEER => 1,
            CURLOPT_SSL_VERIFYHOST => 2,
            CURLOPT_POSTFIELDS => json_encode($data)
        ];
    
        $this->curl = curl_init();
    
        curl_setopt_array($this->curl, $options);
    }
}