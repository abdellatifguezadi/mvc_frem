<?php
session_start();

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config/config.php';

use App\Core\Router;
use App\Core\Database;
use App\Models\User;

require_once __DIR__ . '/../config/routes.php';

$url = $_SERVER['REQUEST_URI'];
if ($pos = strpos($url, '?')) {
    $url = substr($url, 0, $pos);
}
$url = trim($url, '/');

try {
    Router::dispatch($url);
} catch (\Exception $e) {
    http_response_code(404);
    include __DIR__ . '/../app/views/errors/404.php';
}




