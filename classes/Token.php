<?php
declare(strict_types=1);
require_once 'functions/random_bytes_fix.php';
class Token
{
    public static function generate()
    {
        return Session::put(Config::get('session/token_name'), password_hash(random_bytes_no_null(256), PASSWORD_BCRYPT));
    }
    public static function check($token)
    {
        $tokenName = Config::get('session/token_name');
        if (Session::exists($tokenName) && $token === Session::get($tokenName)) {
            Session::delete($tokenName);
            return true;
        }
        return false;
    }
}
