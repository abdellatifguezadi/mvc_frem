<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\View;
use App\Models\User;
use App\Core\Session;
use App\Core\Validator;
use App\Core\Security;
use App\Core\Auth;

class AuthController extends Controller
{
    public function loginPage()
    {
        if (Auth::isLoggedIn()) {
            $user = User::findOrFail(Auth::getCurrentUserId());
            if ($user->isAdmin()) {
                return $this->redirect('/admin/dashboard');
            }
            return $this->redirect('/dashboard');
        }

        return View::render('auth/login', 'auth', [
            'csrf_token' => Security::generateCsrfToken()
        ]);
    }

    public function login()
    {
        if (!isset($_POST['csrf_token']) || !Security::validateCsrfToken($_POST['csrf_token'])) {
            Session::set('error', 'Erreur de sécurité, veuillez réessayer');
            return $this->redirect('/login');
        }

        if (!Validator::validate($_POST, [
            'email' => ['required', 'email'],
            'password' => ['required', ['min', 8]]
        ])) {
            Session::set('error', 
                Validator::getFirstError('email') ?? 
                Validator::getFirstError('password')
            );
            return $this->redirect('/login');
        }

        $user = User::where('email', $_POST['email'])->first();

        if (!$user || !password_verify($_POST['password'], $user->password)) {
            Session::set('error', 'Email ou mot de passe incorrect');
            return $this->redirect('/login');
        }

        Auth::login($user);
        Session::set('success', 'Connexion réussie');
        
        if ($user->isAdmin()) {
            return $this->redirect('/admin/dashboard');
        }
        
        return $this->redirect('/dashboard');
    }

    public function registerPage()
    {
        if (Auth::isLoggedIn()) {
            $user = User::findOrFail(Auth::getCurrentUserId());
            if ($user->isAdmin()) {
                return $this->redirect('/admin/dashboard');
            }
            return $this->redirect('/dashboard');
        }

        return View::render('auth/register', 'auth', [
            'csrf_token' => Security::generateCsrfToken()
        ]);
    }

    public function register()
    {
        if (!isset($_POST['csrf_token']) || !Security::validateCsrfToken($_POST['csrf_token'])) {
            Session::set('error', 'Erreur de sécurité, veuillez réessayer');
            return $this->redirect('/register');
        }

        if (!Validator::validate($_POST, [
            'name' => ['required', 'name', ['min', 3]],
            'email' => ['required', 'email'],
            'password' => ['required', 'password', ['min', 8]]
        ])) {
            Session::set('error', 
                Validator::getFirstError('name') ?? 
                Validator::getFirstError('email') ?? 
                Validator::getFirstError('password')
            );
            return $this->redirect('/register');
        }

        if (User::where('email', $_POST['email'])->exists()) {
            Session::set('error', 'Cet email existe déjà');
            return $this->redirect('/register');
        }

        try {
            $user = User::create([
                'name' => Security::escape($_POST['name']),
                'email' => Security::escape($_POST['email']),
                'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
                'role' => User::ROLE_USER
            ]);

            Session::set('success', 'Inscription réussie');
            return $this->redirect('/login');
        } catch (\Exception $e) {
            Session::set('error', 'Erreur lors de l\'inscription');
            return $this->redirect('/register');
        }
    }

    public function logout()
    {
        Auth::logout();
        Session::set('success', 'Vous avez été déconnecté avec succès');
        return $this->redirect('/login');
    }

    protected function redirect($url)
    {
        header("Location: $url");
        exit;
    }
} 