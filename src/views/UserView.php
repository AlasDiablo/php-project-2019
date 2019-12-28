<?php


namespace mywishlist\views;

use mywishlist\utils\Selection;

class UserView
{

    protected $list, $selecteur, $content;

    public function __construct($l, Selection $s)
    {
        $this->list = $l;
        $this->selecteur = $s;
    }

    private function accountRegister()
    {
        $str = <<<END
        <form method="post" action="/index.php/account/register/add">
            <label>Nom d'utilisateur</label>
            <input type="text" name="username" required>
            <label>Email</label>
            <input type="email" name="email" required>
            <label>Confirmer l'email</label>
            <input type="email" name="email-confirm" required>
            <label>Mot de passe</label>
            <input type="password" name="password" required>
            <label>Confirmer le mot de passe</label>
            <input type="password" name="password-confirm" required>
            <button type="submit" name="submit" value="doRegister">Créer mon compte</button>
        </form>
END;
        return $str;
    }

    private function accountLogin()
    {
        $str = <<<END
<form id="register" method="post" action="/index.php/account/login/submit">
    <label>Nom d'utilisateur</label>
    <input type="text" name="username" required>
    <label>Mot de passe</label>
    <input type="password" name="password" required>
    <button type="submit" name="submit" value="doLogin">Se connecter</button>
</form>
END;
        return $str;
    }

    private function accountChange()
    {
        $str = <<<END
<form id="register" method="post" action="register/post">
    <label>Mot de passe</label>
    <input type="password" name="password-old" required>
    <label>Nouveau mot de passe</label>
    <input type="password" name="password" required>
    <label>Confirmer le nouveau mot de passe</label>
    <input type="password" name="password-confirm" required>
    <button type="submit" name="submit" value="doChange">Appliquer</button>
</form>
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

        if ($this->selecteur->equals(Selection::REGISTER())) $this->content = $this->accountRegister();
        if ($this->selecteur->equals(Selection::REGISTER_POST_FAILED())) $this->content = $this->getDataFailed();
        if ($this->selecteur->equals(Selection::REGISTER_POST_SUCCESS())) $this->content = $this->registerSuccess();
        if ($this->selecteur->equals(Selection::REGISTER_POST_USER_OR_EMAIL_EXSITE())) $this->content = $this->registerUserEmailExists();
        if ($this->selecteur->equals(Selection::LOGIN())) $this->content = $this->accountLogin();
        if ($this->selecteur->equals(Selection::LOGIN_POST_SUCCESS())) $this->content = $this->loginSuccess();
        if ($this->selecteur->equals(Selection::LOGIN_POST_FAILED())) $this->content = $this->getDataFailed();
        if ($this->selecteur->equals(Selection::LOGIN_POST_USERPASS_WRONG())) $this->content = $this->loginBadUserPass();
        if ($this->selecteur->equals(Selection::LOGOUT())) $this->content = $this->logout();

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