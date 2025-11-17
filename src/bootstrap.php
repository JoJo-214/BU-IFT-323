<?php
$config = require __DIR__ . '/../config/config.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

spl_autoload_register(function ($class) {
    $file = __DIR__ . '/' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($file)) require $file;
});

use Model\Database;

Database::init($config['db']);
define('BASE_URL', rtrim($config['base_url'], '/'));