<?php

namespace App\Core;

class Auth
{
    public static function login($user)
    {
        Session::set('user_id', $user->id);
        Session::set('user_role', $user->role);
        
    }
    
    public static function logout()
    {
        Session::destroy();
    }
    
    public static function isLoggedIn()
    {
        return Session::has('user_id');
    }
    
    public static function getCurrentUserId()
    {
        if (!Session::has('user_id')) {
            return null;
        }
        return Session::get('user_id', null, false);
    }
    
    public static function hasRole($role)
    {
        if (!Session::has('user_role')) {
            return false;
        }
        return Session::get('user_role', null, false) === $role;
    }
}
