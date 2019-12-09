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
        if (isset($_POST['submit'])) if ($_POST['submit'] == 'doRegister') {
            $user_data = array();
            // check du nom d'utilisateur
            if (isset($_POST['username'])) {
                $user_data['username'] = filter_var($_POST['username'], FILTER_DEFAULT);
            } else {
                self::post_failed();
                return;
            }
            // check de l'email
            if (isset($_POST['email'])) {
                $user_data['email'] = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
            } else {
                self::post_failed();
                return;
            }
            // check de l'email de verification
            if (isset($_POST['email-confirm'])) {
                $user_data['email-confirm'] = filter_var($_POST['email-confirm'], FILTER_VALIDATE_EMAIL);
            } else {
                self::post_failed();
                return;
            }
            // Check si les email identique
            if ($user_data['email'] != $user_data['email-confirm']) {
                self::post_failed_email();
                return;
            }

            // check du mot de passe
            if (isset($_POST['password'])) {
                $user_data['password'] = filter_var($_POST['password'], FILTER_DEFAULT);
            } else {
                self::post_failed();
                return;
            }
            // check du mot de passe de verification
            if (isset($_POST['password-confirm'])) {
                $user_data['password-confirm'] = filter_var($_POST['password-confirm'], FILTER_DEFAULT);
            } else {
                self::post_failed();
                return;
            }
            // Check si les mot de passe sont identique
            if ($user_data['password'] != $user_data['password-confirm']) {
                self::post_failed_pass();
                return;
            }



            // TODO ajout la creation du compte + creation d'un session et/ou cookie.



        }
    }
    private static function post_failed()
    {
        $render = new RenderHandler(Registries::REGISTER_POST_FAILED, null);
        $render->render();
    }

    private static function post_failed_email()
    {
        $render = new RenderHandler(Registries::REGISTER_POST_EMAIL_FAILED, null);
        $render->render();
    }

    private static function post_failed_pass()
    {
        $render = new RenderHandler(Registries::REGISTER_POST_PASSWORD_FAILED, null);
        $render->render();
    }
}