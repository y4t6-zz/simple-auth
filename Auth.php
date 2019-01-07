<?php
require 'Cookie.php';

class Auth
{
    protected $authorized = false;
    protected $hashUser;

    public function authorized()
    {
        return $this->authorized;
    }

    public function hashUser()
    {
        return Cookie::get('auth_user');
    }

    public function authorize($hash)
    {
        Cookie::set('auth_authorized', true);
        Cookie::set('auth_user', $hash);
    }

    public function unAuthorize()
    {
        Cookie::delete('auth_authorized');
        Cookie::delete('auth_user');
    }

    public static function salt()
    {
        return (string) rand(10000000, 99999999);
    }

    public static function encryptPassword($password, $salt = '')
    {
        return hash('sha256', $password . $salt);
    }
}