<?php


namespace mywishlist\views;

use mywishlist\utils\Selection;

class UserView
{

    protected $list, $selecteur, $content;

    public function __construct($l, $s)
    {
        $this->list = $l;
        $this->selecteur = $s;
    }

    private function accountRegisterAndLogin()
    {
        return <<<BODY
<div id="user-form">
    <div id="register-div" class="user-form">
        <h2>Creation d'un compte</h2>
        <form method="post" action="/index.php/account/register_post">
            <label>Nom d'utilisateur :</label><br>
            <input type="text" name="username" required><br>
            <label>Email :</label><br>
            <input type="email" name="email" required><br>
            <label>Confirmer l'email :</label><br>
            <input type="email" name="email-confirm" required><br>
            <label>Mot de passe :</label><br>
            <input type="password" name="password" required><br>
            <label>Confirmer le mot de passe :</label><br>
            <input type="password" name="password-confirm" required><br><br>
            <button type="submit" name="submit" value="doRegister">Créer mon compte</button>
        </form>
    </div>
    <div id="login-div" class="user-form">
        <h2>Connection a un compte</h2>
        <form id="register" method="post" action="/index.php/account/login_post">
            <label>Nom d'utilisateur :</label><br>
            <input type="text" name="username" required><br>
            <label>Mot de passe :</label><br>
            <input type="password" name="password" required><br><br>
            <button type="submit" name="submit" value="doLogin">Se connecter</button>
        </form>
    </div>
</div>
BODY;

    }

    private function accountChange($username, $email, $gravatar)
    {
        $str = <<<END
<div>
    <img src="$gravatar" alt="gravatar">
    <a href="https://fr.gravatar.com">Changé mon Gravatar</a>
    <label>Nom d'utilisateur</label>
    <input type="text" value="$username" name="username" disabled="disabled">
    <form id="email-change" method="post" action="register/post/email">
        <label>Email</label>
        <input type="email" value="$email" name="old-email" disabled="disabled">
        <label>Nouvelle email</label>
        <input type="email" name="new-email">
        <label>Mot de passe</label>
        <input type="password" name="password" required>
        <button type="submit" name="submit" value="doChange">Appliquer</button>
    </form>
    <form id="password-change" method="post" action="register/post/password">
        <label>Mot de passe</label>
        <input type="password" name="password-old" required>
        <label>Nouveau mot de passe</label>
        <input type="password" name="password" required>
        <label>Confirmer le nouveau mot de passe</label>
        <input type="password" name="password-confirm" required>
        <button type="submit" name="submit" value="doChange">Appliquer</button>
    </form>
</div>

END;
        return $str;
    }


    private function getDataFailed()
    {
        $str = <<<END
<p>Une erreur lors de la récupération des données saisies</p>
END;
        return $str;
    }

    private function registerUserEmailExists()
    {
        $str = <<<END
<p>L'utilisateur ou l'email est déjà enregistré</p>
END;
        return $str;
    }

    private function registerSuccess()
    {
        $str = <<<END
<p>Vous êtes enregistré !</p>
END;
        return $str;
    }

    private function loginSuccess()
    {
        $str = <<<END
<p>Vous êtes connecté !</p>
END;
        return $str;
    }

    private function loginBadUserPass()
    {
        $str = <<<END
<p>L'utilisateur ou le mot de passe sont erronés</p>
END;
        return $str;
    }

    private function logout()
    {
        $str = <<<END
<p>Vous êtes déconnecté !</p>
END;
        return $str;
    }

    public function render()
    {
        switch ($this->selecteur)
        {
            case Selection::ACCOUNT:
                $this->content = $this->accountRegisterAndLogin();
                break;
            case Selection::LOGIN_POST_FAILED:
            case Selection::REGISTER_POST_FAILED:
                $this->content = $this->getDataFailed();
                break;
            case Selection::REGISTER_POST_SUCCESS:
                $this->content = $this->registerSuccess();
                break;
            case Selection::REGISTER_POST_USER_OR_EMAIL_EXSITE:
                $this->content = $this->registerUserEmailExists();
                break;
            case Selection::LOGIN_POST_SUCCESS:
                $this->content = $this->loginSuccess();
                break;
            case Selection::LOGIN_POST_USERPASS_WRONG:
                $this->content = $this->loginBadUserPass();
                break;
            case Selection::LOGOUT:
                $this->content = $this->logout();
                break;
            case Selection::CHANGE_USER:
                $this->content = $this->accountChange($this->list['username'], $this->list['email'], $this->list['gravatar']);
                break;
            case Selection::CHANGE_USER_UNAUTHORIZED:
                $this->content = (new GlobalView())->unauthorized();
                break;
            default:
                $this->content = "Switch Constant Error";
                break;
        }

        $body = <<<END
<div id="content">
    <div id="content-inner">
    
         $this->content
        
    </div>
</div>
END;
        ViewRendering::render($body);
    }

}