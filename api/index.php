<?php
/**
 * Here is the serverless function entry
 * for deployment with Vercel.
 */

// Get the requested PHP file
$request_uri = $_SERVER['REQUEST_URI'];
$script_name = basename($request_uri);

// If it's a direct PHP file request
if (preg_match('/\.php$/', $script_name)) {
    $file_path = __DIR__ . '/../' . $script_name;
    if (file_exists($file_path)) {
        require_once $file_path;
        exit;
    }
}

// Default to index.php if no specific file is found
require_once __DIR__.'/../index.php';