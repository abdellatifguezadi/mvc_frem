<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\View;
use App\Models\User;
use App\Core\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        if (!Auth::isLoggedIn()) {
            return $this->redirect('/login');
        }

        $user = User::findOrFail(Auth::getCurrentUserId());

        if (!$user || $user->role !== User::ROLE_ADMIN) {
            return $this->redirect('/dashboard');
        }

        return View::render('admin/dashboard', 'app', ['user' => $user]);
    }

} 