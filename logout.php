<?php
declare(strict_types=1);
require_once __DIR__ . '/core/init.php';

$user = new User();
$user->logout();

Redirect::to('index.php');