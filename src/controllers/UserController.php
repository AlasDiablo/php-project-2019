<?php


namespace mywishlist\controllers;


use mywishlist\utils\Registries;
use mywishlist\views\RenderHandler;

class UserController
{
    public static function register()
    {
        $render = new RenderHandler(Registries::REGISTER, null);
        $render->render();
    }

    public static function register_post()
    {

    }
}