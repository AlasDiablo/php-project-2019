<?php


namespace mywishlist\controllers;


use mywishlist\utils\Registries;
use mywishlist\views\ViewUserRegister;

class UserController
{
    public static function register()
    {
        $render = new ViewUserRegister(Registries::REGISTER);
        echo $render->render();
    }

    public static function register_post()
    {

    }
}