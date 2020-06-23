<?php 

use App\Config\Config;
use AmoCRM\Client\AmoCRMApiClient;

require "../vendor/autoload.php";

session_start();

$config = new Config();

$client = new AmoCRMApiClient(
    $config->CLIENT_ID,
    $config->CLIENT_SECRET,
    $config->CLIENT_REDIRECT_URI
);

$client->setAccountBaseDomain( $config->CLIENT_REFERER );