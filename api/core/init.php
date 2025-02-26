<?php
declare(strict_types=1);

session_start();
error_reporting(E_ALL ^ E_NOTICE);
date_default_timezone_set('Europe/Belgrade');

// Load environment variables if .env file exists
if (file_exists(__DIR__ . '/../.env')) {
    $env_lines = file(__DIR__ . '/../.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($env_lines as $line) {
        if (strpos($line, '=') !== false && strpos($line, '#') !== 0) {
            list($key, $value) = explode('=', $line, 2);
            $_ENV[trim($key)] = trim($value);
            $_SERVER[trim($key)] = trim($value);
        }
    }
}

$GLOBALS['config'] = array(
    'mysql' => array(
        'host' => $_ENV['DB_HOST'] ?? 'localhost',
        'port' => $_ENV['DB_PORT'] ?? '3306',
        'username' => $_ENV['DB_USERNAME'] ?? 'root',
        'password' => $_ENV['DB_PASSWORD'] ?? '',
        'db' => $_ENV['DB_NAME'] ?? 'cars'
    ),
    'session' => array(
        'session_name' => 'user',
        'token_name' => 'token'
    )
);

spl_autoload_register(
    function ($class) {
        include_once __DIR__ . '/classes/' . $class . '.php';
    }
);
require_once __DIR__ . '/../functions/sanitize.php';
require_once __DIR__ . '/../functions/user_type.php';
