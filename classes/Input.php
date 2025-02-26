<?php
declare(strict_types=1);

class Input
{
    public static function exists($type = 'post')
    {
        $type = strtolower($type);
        switch ($type) {
            case 'post':
                return (!empty($_POST)) ? true : false;
            case 'get':
                return (!empty($_GET)) ? true : false;
            case 'put':
                return (!empty($_PUT)) ? true : false;
            case 'head':
                return (!empty($_HEAD)) ? true : false;
            case 'cookie':
                return (!empty($_COOKIE)) ? true : false;
            case 'files':
                return (!empty($_FILES)) ? true : false;
            case 'env':
                return (!empty($_ENV)) ? true : false;
            case 'request':
                return (!empty($_REQUEST)) ? true : false;
            case 'session':
                return (!empty($_SESSION)) ? true : false;
            default:
                throw new Exception('Ne postoji takav zahtev');
        }
    }
    public static function get($item)
    {
        if (isset($_POST[$item])) {
            return $_POST[$item];
        } elseif (isset($_GET[$item])) {
            return $_GET[$item];
        }
        return '';
    }
}
