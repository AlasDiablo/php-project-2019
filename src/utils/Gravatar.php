<?php


namespace mywishlist\utils;

/**
 * Class Gravatar
 * @package mywishlist\utils
 */
class Gravatar
{
    /**
     * Implemantation des gravatar.
     * @param $email string Email de l'utilisateurs.
     * @param int $s int Tails de l'images (Par defaut 256 pixel de côté).
     * @return string Urls du gravatar.
     */
    public static function getGravatar($email, $s = 256) {
        $url = 'https://www.gravatar.com/avatar/';
        $url .= md5(strtolower(trim($email)));
        $url .= "?s=$s&d=retro&r=g";
        return $url;
    }
}