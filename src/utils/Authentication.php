<?php


namespace mywishlist\utils;


use mywishlist\models\User;

class Authentication
{
    const ANONYMOUS  = 0; // default user id & user level
    const USER = 1; // user level f
    const ADMIN = 2;
    const SUPER_ADMIN = 3;

    public static function getUserLevel(): int
    {
        session_start();
        if (isset($_SESSION['user_id']))
        {
            if (isset(User::select('user_level')->where('user_id', '=', $_SESSION['user_id'])->get()[0])) {
                return User::select('user_level')->where('user_id', '=', $_SESSION['user_id'])->get()[0]['user_level'];
            } else {
                $_SESSION['user_id'] = self::ANONYMOUS;
                return self::ANONYMOUS;
            }
        } else {
          $_SESSION['user_id'] = self::ANONYMOUS;
          return self::ANONYMOUS;
        }
    }
}