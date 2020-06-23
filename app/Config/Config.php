<?php 

namespace App\Config;

use App\Exceptions\UndefinedConfigException;

class Config {
    private $APP_ROOT;

    public function __construct() {
        $this->APP_ROOT = dirname(__DIR__);
    }

    function __get($prop) {
        if (isset($this->$prop)) {
            return $this->$prop;
        } else {
            throw new UndefinedConfigException;
        }
    }
}