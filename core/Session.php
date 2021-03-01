<?php


namespace app\core;


class Session
{

    public function __construct()
    {
//        session_destroy();
        session_start();
    }

    public static function isUserLoggedIn(): bool
    {
        if (isset($_SESSION['userId'])) {
            return true;
        }
        return false;
    }

}