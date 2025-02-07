<?php

namespace App\Core;

abstract class Controller
{
    protected function render($view, $data = [])
    {
        return View::render($view, $data);
    }
    
    protected function redirect($url)
    {
        header("Location: $url");
        exit;
    }
}
