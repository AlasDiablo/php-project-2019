<?php

namespace mywishlist\utils;

use mywishlist\models\User;

/**
 * Class Authentication, Class appelé pour tous se qui conserne l'utilisateurs
 * @package mywishlist\utils
 */
class Authentication
{
    /**
     * Tous les constante corespondant au niveau d'action des utilisateurs
     */
    const ANONYMOUS  = 0; // default user id & user level
    const USER = 1; // user level by default
    const ADMIN = 2;
    const SUPER_ADMIN = 3;

    /**
     * Fonction qui permette d'optenir le niveau d'action du l'utilisé
     * @return int niveau d'action
     */
    public static function getUserLevel(): int
    {
        if (isset($_SESSION['user_id']))
        {
            if (isset(User::select('user_level')->where('user_id', '=', $_SESSION['user_id'])->get()[0]))
            {
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

    /**
     * Fonction qui permette d'avoir le nom d'utilisateurs associer a l'utilsateurs
     * @return string nom d'utilisateurs associer a l'utilsateurs
     */
    public static function getUsername()
    {
        if (self::getUserLevel() != self::ANONYMOUS)
        {
            return User::select('username')->where('user_id', '=', $_SESSION['user_id'])->first()->username;
        } else {
            return 'anonymous';
        }
    }

    /**
     * Fonction qui permette d'avoir l'id associée a l'utilisateur
     * @return int|mixed id de l'utisateurs
     */
    public static function getUserId()
    {
        if (self::getUserLevel() != self::ANONYMOUS)
        {
            return $_SESSION['user_id'];
        } else {
            return 0;
        }
    }

    /**
     * Fonction utilisé pour optenir l'emil de l'utisateurs
     * @return string email de l'utilisateurs
     */
    public static function getEmail()
    {
        if (self::getUserLevel() != self::ANONYMOUS)
        {
            return User::select('email')->where('user_id', '=', $_SESSION['user_id'])->first()->email;
        } else {
            return '';
        }
    }
}