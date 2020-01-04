<?php


namespace mywishlist\views;

use mywishlist\utils\Selection;

class UserView
{

    private $list, $selecteur, $content;

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
    <a href="https://fr.gravatar.com">Changer mon Gravatar</a>
    <label>Nom d'utilisateur</label>
    <input type="text" value="$username" name="username" disabled="disabled">
    <form id="email-change" method="post" action="/account/edit/email">
        <label>Email</label>
        <input type="email" value="$email" name="old-email" disabled="disabled">
        <label>Nouvel email</label>
        <input type="email" name="new-email">
        <label>Mot de passe</label>
        <input type="password" name="password" required>
        <button type="submit" name="submit" value="doEmailChange">Appliquer</button>
    </form>
    <form id="password-change" method="post" action="/account/edit/password">
        <label>Mot de passe</label>
        <input type="password" name="password-old" required>
        <label>Nouveau mot de passe</label>
        <input type="password" name="password" required>
        <label>Confirmer le nouveau mot de passe</label>
        <input type="password" name="password-confirm" required>
        <button type="submit" name="submit" value="doChange">Appliquer</button>
    </form>
    <form id="delete" method="post" action="/account/edit/delete">
        <button type="submit" name="submit" value="doDelete">Supprimer mon compte</button>
    </form>
</div>

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
                $this->content = "<p class=\"post-code\">Une erreur lors de la récupération des données saisies</p>";
                break;
            case Selection::REGISTER_POST_SUCCESS:
                $this->content = "<p class=\"post-code\">Vous êtes enregistré !</p>";
                break;
            case Selection::REGISTER_POST_USER_OR_EMAIL_EXSITE:
                $this->content = "<p class=\"post-code\">L'utilisateur ou l'email est déjà enregistré</p>";
                break;
            case Selection::LOGIN_POST_SUCCESS:
                $this->content = "<p class=\"post-code\">Vous êtes connecté !</p>";
                break;
            case Selection::LOGIN_POST_USERPASS_WRONG:
                $this->content = "<p class=\"post-code\">L'utilisateur ou le mot de passe sont erronés</p>";
                break;
            case Selection::LOGOUT:
                $this->content = "<p class=\"post-code\">Vous êtes déconnecté !</p>";
                break;
            case Selection::CHANGE_USER:
                $this->content = $this->accountChange($this->list['username'], $this->list['email'], $this->list['gravatar']);
                break;
            case Selection::ACCOUNT_DELETE:
                $this->content = "<p class=\"post-code\">Compte supprimé !</p>";
                break;
            case Selection::CHANGE_OK:
                $this->content = "<p class=\"post-code\">Votre compte a été mis à jour, reconnectez vous.</p>";
                break;
            case Selection::CHANGE_EMAIL_ERROR:
                $this->content = "<p class=\"post-code\">Un probléme et survenue avec l'email donnée.</p>";
                break;
            default:
                GlobalView::teapot();
                return;
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