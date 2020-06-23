<?php 

namespace App\Config;

use App\Exceptions\UndefinedConfigException;

class Config {
    private $APP_ROOT;
    private $URL_ROOT;
    private $CLIENT_ID;
    private $CLIENT_SECRET;
    private $CLIENT_REDIRECT_URI;
    private $CLIENT_REFERER;

    public function __construct() {
        $this->URL_ROOT                 = "http://localhost";
        $this->APP_ROOT                 = dirname(__DIR__);
        $this->CLIENT_REFERER           = "skidanovilia.amocrm.ru";
        $this->CLIENT_ID                = "607c8998-4cf9-40e7-89ff-c4a6f049388f";
        $this->CLIENT_SECRET            = "zqJdf0rzRBOJXnBnSwiDWCPlmpivssQkMY6MSSkP1csZQGxtsSEEkKlIXCz8gTKo";
        $this->CLIENT_REDIRECT_URI      = "http://327439-cp75658.tmweb.ru/";
    }

    function __get($prop) {
        if (isset($this->$prop)) {
            return $this->$prop;
        } else {
            throw new UndefinedConfigException;
        }
    }
}