<?php


namespace mywishlist\controllers;


use mywishlist\models\User;
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
                $val = filter_var($_POST['username'], FILTER_DEFAULT);
                if ($val != FALSE) {
                    $user_data['username'] = $val;
                } else{
                    self::post_failed();
                    return;
                }
            } else {
                self::post_failed();
                return;
            }

            // check de l'email
            if (isset($_POST['email'])) {
                $val = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
                if ($val != FALSE) {
                    $user_data['email'] = $val;
                } else{
                    self::post_failed();
                    return;
                }
            } else {
                self::post_failed();
                return;
            }

            // check de l'email de verification
            if (isset($_POST['email-confirm'])) {

                $val = filter_var($_POST['email-confirm'], FILTER_VALIDATE_EMAIL);
                if ($val != FALSE) {
                    $user_data['email-confirm'] = $val;
                } else{
                    self::post_failed();
                    return;
                }
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

                $val = filter_var($_POST['password'], FILTER_DEFAULT);
                if ($val != FALSE) {
                    $user_data['password'] = $val;
                } else{
                    self::post_failed();
                    return;
                }
            } else {
                self::post_failed();
                return;
            }

            // check du mot de passe de verification
            if (isset($_POST['password-confirm'])) {

                $val = filter_var($_POST['password-confirm'], FILTER_DEFAULT);
                if ($val != FALSE) {
                    $user_data['password-confirm'] = $val;
                } else{
                    self::post_failed();
                    return;
                }
            } else {
                self::post_failed();
                return;
            }

            // Check si les mot de passe sont identique
            if ($user_data['password'] != $user_data['password-confirm']) {
                self::post_failed_pass();
                return;
            }


            if (self::checkIfEmailExsite($user_data['email']) && self::checkIfUsernameExsite($user_data['username'])) {
                $user = new User();
                $user->email = $user_data['email'];
                $user->username = $user_data['username'];
                $user->password_hash = password_hash($user_data['password'], PASSWORD_DEFAULT);
                $user->save();
            } else {
                self::post_failed_user_or_email_exsite();
                return;
            }

            // TODO ajout la creation du compte + creation d'un session et/ou cookie.

            $render = new RenderHandler(Registries::REGISTER_POST, null);
            $render->render();


        }
    }

    private static function checkIfEmailExsite($email) {
        $value = User::where('email', '=', $email)->get();
        if (isset($value)) {
            return count($value) == 0;
        } else {
            return true;
        }
    }

    private static function checkIfUsernameExsite($username) {
        $value = User::where('username', '=', $username)->get();
        if (isset($value)) {
            return count($value) == 0;
        } else {
            return true;
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

    private static function post_failed_user_or_email_exsite()
    {
        $render = new RenderHandler(Registries::REGISTER_POST_USER_OR_EMAIL_EXSITE, null);
        $render->render();
    }
}