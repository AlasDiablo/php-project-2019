<?php


namespace mywishlist\controllers;


use mywishlist\utils\Registries;
use mywishlist\views\ViewUserRegister;

class ControllerUser
{
    public static function register()
    {
        $render = new ViewUserRegister(Registries::REGISTER);
        echo $render->render();
    }

    public static function regsiter_post()
    {

    }
}