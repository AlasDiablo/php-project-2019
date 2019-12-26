<?php


namespace mywishlist\controllers;


use mywishlist\utils\Selection;
use mywishlist\views\UserView;
use mywishlist\models\User;
use mywishlist\utils\Registries;
use mywishlist\views\RenderHandler;

class UserController
{
    public function register()
    {
        $v = new UserView(null, Selection::REGISTER());
        $v->render();
    }

    public function login()
    {
        $v = new UserView(null, Selection::LOGIN());
        $v->render();
    }

    public function logout()
    {
        session_destroy();
        $render = new UserView(null, Selection::LOGOUT());
        $render->render();
    }

    public function register_post()
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
                $user->user_level = 1;
                $user->user_id = self::getNewUserId();
                self::getNewUserId();
                $user->save();
                self::createSession($user_data['username']);
            } else {
                self::post_failed_user_or_email_exsite();
                return;
            }

            $v = new UserView(null, Selection::REGISTER_POST_SUCCESS());
            $v->render();

        }
    }

    public function login_post()
    {
        if (isset($_POST['submit'])) if ($_POST['submit'] == 'doLogin') {
            $user_data = array();
            // check du nom d'utilisateur
            if (isset($_POST['username'])) {
                $val = filter_var($_POST['username'], FILTER_DEFAULT);
                if ($val != FALSE) {
                    $user_data['username'] = $val;
                } else {
                    $render = new UserView(null, Selection::LOGIN_POST_FAILED());
                    $render->render();
                    return;
                }
            } else {
                $render = new UserView(null, Selection::LOGIN_POST_FAILED());
                $render->render();
                return;
            }
            // check du mot de passe
            if (isset($_POST['password'])) {
                $val = filter_var($_POST['password'], FILTER_DEFAULT);
                if ($val != FALSE) {
                    $user_data['password'] = $val;
                } else{
                    $render = new UserView(null, Selection::LOGIN_POST_FAILED());
                    $render->render();
                    return;
                }
            } else {
                $render = new UserView(null, Selection::LOGIN_POST_FAILED());
                $render->render();
                return;
            }
            if (!self::checkIfUsernameExsite($user_data['username'])) {
                if (password_verify($user_data['password'], User::select('password_hash')->where('username', '=', $user_data['username'])->get())) {
                    self::createSession($user_data['username']);
                    $render = new UserView(null, Selection::LOGIN_POST_SUCCESS());
                    $render->render();
                } else {
                    $render = new UserView(null, Selection::LOGIN_POST_USERPASS_WRONG());
                    $render->render();
                    return;
                }
            } else {
                $render = new UserView(null, Selection::LOGIN_POST_USERPASS_WRONG());
                $render->render();
                return;
            }
        }
    }

    public function change_password()
    {
        if (isset($_POST['submit'])) if ($_POST['submit'] == 'doRegister') {
            $user_data = array();
            // check du mot de passe
            if (isset($_POST['password'])) {
                $val = filter_var($_POST['password'], FILTER_DEFAULT);
                if ($val != FALSE) {
                    $user_data['password'] = $val;
                } else{
                    $render = new RenderHandler(Registries::CHANGE_FAILD, null);
                    $render->render();
                    return;
                }
            } else {
                $render = new RenderHandler(Registries::CHANGE_FAILD, null);
                $render->render();
                return;
            }
            // check du mot de passe de verification
            if (isset($_POST['password-confirm'])) {
                $val = filter_var($_POST['password-confirm'], FILTER_DEFAULT);
                if ($val != FALSE) {
                    $user_data['password-confirm'] = $val;
                } else{
                    $render = new RenderHandler(Registries::CHANGE_FAILD, null);
                    $render->render();
                    return;
                }
            } else {
                $render = new RenderHandler(Registries::CHANGE_FAILD, null);
                $render->render();
                return;
            }
            // check du mot de passe exsitant
            if (isset($_POST['password-old'])) {
                $val = filter_var($_POST['password-old'], FILTER_DEFAULT);
                if ($val != FALSE) {
                    $user_data['password-old'] = $val;
                } else{
                    $render = new RenderHandler(Registries::CHANGE_FAILD, null);
                    $render->render();
                    return;
                }
            } else {
                $render = new RenderHandler(Registries::CHANGE_FAILD, null);
                $render->render();
                return;
            }
            // Check si les mot de passe sont identique
            if ($user_data['password'] != $user_data['password-confirm']) {
                $render = new RenderHandler(Registries::CHANGE_BAD_PASSWORD, null);
                $render->render();
                return;
            }
            if (!self::checkIfUsernameExsite($_SESSION['username'])) {
                if (password_verify($user_data['password-old'], User::select('password_hash')->where('user', '=', $_SESSION['username']))) {
                    $user = User::find($_SESSION['username']);
                    $user->password_hash = password_hash($user_data['password'], PASSWORD_DEFAULT);
                    $user->save();
                    self::logout();
                } else {
                    $render = new RenderHandler(Registries::CHANGE_BAD_PASSWORD, null);
                    $render->render();
                    return;
                }
            } else {
                $render = new RenderHandler(Registries::CHANGE_USER_ERROR, null);
                $render->render();
                return;


            }
        }
    }

    private static function createSession($user) {
        session_start();
        $_SESSION['user_id'] = $user;
    }


    private static function getNewUserId()
    {
        return User::max('user_id') + 1;
    }

    private static function checkIfEmailExsite($email)
    {
        $value = User::where('email', '=', $email)->get();
        if (isset($value)) {
            return count($value) == 0;
        } else {
            return true;
        }
    }

    private static function checkIfUsernameExsite($username)
    {
        $value = User::where('username', '=', $username)->get();
        if (isset($value)) {
            return count($value) == 0;
        } else {
            return true;
        }
    }

    private static function post_failed()
    {
        $v = new UserView(null, Selection::REGISTER_POST_FAILED());
        $v->render();
    }

    private static function post_failed_email()
    {
        $v = new UserView(null, Selection::REGISTER_POST_FAILED());
        $v->render();
    }

    private static function post_failed_pass()
    {
        $v = new UserView(null, Selection::REGISTER_POST_FAILED());
        $v->render();
    }

    private static function post_failed_user_or_email_exsite()
    {
        $v = new UserView(null, Selection::REGISTER_POST_USER_OR_EMAIL_EXSITE());
        $v->render();
    }
}