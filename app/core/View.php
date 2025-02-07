<?php

namespace App\Core;

class View
{
    private static $layout = 'app';
    
    public static function render($view, $layout = null, $data = [])
    {
        if ($layout !== null) {
            self::$layout = $layout;
        }
        
        extract($data);

        $viewPath = APP_PATH . '/views/' . $view . '.php';
        $layoutPath = APP_PATH . '/views/layouts/' . self::$layout . '.php';

        ob_start();
        require $viewPath;
        $content = ob_get_clean();
        
        ob_start();
        require $layoutPath;
        echo ob_get_clean();
        return true;
    }
    
    public static function escape($string)
    {
        return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
    }
}
