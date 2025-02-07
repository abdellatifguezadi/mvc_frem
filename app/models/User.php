<?php
namespace App\Models;

use App\Core\Model;

class User extends Model
{
    protected $table = 'users'; 
    protected $fillable = ['name', 'email', 'password', 'role']; 
    public $timestamps = true;

    const ROLE_ADMIN = 'admin';
    const ROLE_USER = 'user';

    public function isAdmin()
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function isUser()
    {
        return $this->role === self::ROLE_USER;
    }
} 