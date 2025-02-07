<?php

namespace App\Core;

class Session
{
    public static function start()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }
    
    public static function set($key, $value)
    {
        self::start();
        $_SESSION[$key] = $value;
    }
    
    public static function get($key, $default = null, $remove = false)
    {
        self::start();
        if (!isset($_SESSION[$key])) {
            return $default;
        }
        
        $value = $_SESSION[$key];
        
        if ($remove) {
            unset($_SESSION[$key]);
        }
        
        return $value;
    }
    
    public static function has($key)
    {
        self::start();
        return isset($_SESSION[$key]);
    }
    
    public static function remove($key)
    {
        self::start();
        unset($_SESSION[$key]);
    }
    
    public static function destroy()
    {
        self::start();
        session_destroy();
    }
}
