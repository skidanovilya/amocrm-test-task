<?php 

namespace App\Helpers;

use App\Config\Config;
use App\Exceptions\TemplateNotFoundException;

class Renderer {
    public static function render( $template_name, $data ) {
        $config = new Config();
        
        $template_path = $config->APP_ROOT . "/Templates/" . trim($template_name, "/") . ".php";

        if (file_exists($template_path)) {
            require $template_path;
        } else {
            throw new TemplateNotFoundException;
        }
    }
}