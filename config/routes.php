<?php

use App\Core\Router;
use App\Controllers\AuthController;
use App\Controllers\AdminController;
use App\Controllers\UserController;

// Routes pour l'authentification
Router::add('GET', '', [AuthController::class, 'loginPage']);
Router::add('GET', 'login', [AuthController::class, 'loginPage']);
Router::add('POST', 'login', [AuthController::class, 'login']);
Router::add('GET', 'register', [AuthController::class, 'registerPage']);
Router::add('POST', 'register', [AuthController::class, 'register']);
Router::add('GET', 'logout', [AuthController::class, 'logout']);

// Routes pour l'admin
Router::add('GET', 'admin/dashboard', [AdminController::class, 'dashboard']);


// Routes pour l'utilisateur
Router::add('GET', 'dashboard', [UserController::class, 'dashboard']);




