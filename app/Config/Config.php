<?php 

namespace App\Config;

use App\Exceptions\UndefinedConfigException;

class Config {
    private $APP_ROOT;
    private $URL_ROOT;
    private $CLIENT_ID;
    private $CLIENT_SECRET;
    private $CLIENT_REDIRECT_URI;
    private $CLIENT_SUBDOMAIN;

    public function __construct() {
        $this->URL_ROOT                 = "http://localhost";
        $this->APP_ROOT                 = dirname(__DIR__);
        $this->CLIENT_ID                = "CLIENT_ID";
        $this->CLIENT_SECRET            = "CLIENT_SECRET";
        $this->CLIENT_REDIRECT_URI      = "CLIENT_REDIRECT_URI";
        $this->CLIENT_SUBDOMAIN         = "CLIENT_SUBDOMAIN";
    }

    function __get($prop) {
        if (isset($this->$prop)) {
            return $this->$prop;
        } else {
            throw new UndefinedConfigException;
        }
    }
}