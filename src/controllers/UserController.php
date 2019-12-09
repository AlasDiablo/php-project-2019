<?php


namespace mywishlist\controllers;


use mywishlist\utils\Registries;
use mywishlist\views\RenderHandler;
use Slim\Slim;

class UserController
{
    public static function register()
    {
        $render = new RenderHandler(Registries::REGISTER, null);
        $render->render();
    }

    public static function register_post()
    {
        if (isset($_POST[''])) {
            $render = new RenderHandler(Registries::REGISTER_POST_FAILED, null);
            $render->render();
        }
    }
}