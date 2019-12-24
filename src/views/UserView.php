<?php


namespace mywishlist\views;


use mywishlist\utils\Registries;

class UserView implements IView
{

    public function render(string $code, $data_set): array
    {
        switch ($code)
        {
            case Registries::REGISTER:
                return $this->registerFrom();
            case Registries::REGISTER_POST:
                return array('html' => 'you are register');
            case Registries::REGISTER_POST_FAILED:
                return array('html' => 'Probléme dans la recuperation des donnée saisi');
            case Registries::REGISTER_POST_EMAIL_FAILED:
                return array('html' => 'L\'email donnée est invalide');
            case Registries::REGISTER_POST_PASSWORD_FAILED:
                return array('html' => 'Le mot de passe donnée est invalide');
            case Registries::REGISTER_POST_USER_OR_EMAIL_EXSITE:
                return array('html' => 'l\'email et/ou l\'utilisateur exsite deja');
            case Registries::LOGIN:
                return $this->loginFrom();
            case Registries::CHANGE:
                return $this->changeFrom();
            case Registries::LOGIN_BAD_PASSWORD:
                return array('html' => 'Le mot de pass donnée et erroné');
            case Registries::LOGIN_BAD_USER:
                return array('html' => 'L\'utilisateur donnée n\'exsite pas');
            case Registries::LOGIN_FAILD:
                return array('html' => 'Les donnée rentré sont invalide veuielle les verifier');
            case Registries::LOGIN_POST:
                return array('html' => 'Vous etais conecté');
            case Registries::CHANGE_BAD_PASSWORD:
                return array('html' => 'Le mot de pass donnée et erroné');
            case Registries::CHANGE_FAILD:
                return array('html' => 'Les donnée rentré sont invalide veuielle les verifier');
            case Registries::CHANGE_USER_ERROR:
                return array('html' => 'Un erreur inatendu ces produite votre nom d\'utilisateur ne corespond a rien d\'exsitent...');
            case Registries::CHANGE_POST:
                return array('html' => 'Mot de pass changé, reconecté vous');
        }
    }


    private function registerFrom(): array
    {
        $html = <<<END
<form id="register" method="post" action="register/post">
    <label>Nom d'utilisateur</label>
    <input type="text" name="username" required>
    <label>Email</label>
    <input type="email" name="email" required>
    <label>Confirmé l'email</label>
    <input type="email" name="email-confirm" required>
    <label>Mot de passe</label>
    <input type="password" name="password" required>
    <label>Cofirmé le mot de passe</label>
    <input type="password" name="password-confirm" required>
    <button type="submit" name="submit" value="doRegister">Créer mon compte</button>
</form>
END;
        return array('html' => $html, 'css' => '', 'title' => 'Creation d\'un compte');
    }


    private function loginFrom(): array
    {
        $html = <<<END
<form id="register" method="post" action="register/post">
    <label>Nom d'utilisateur</label>
    <input type="text" name="username" required>
    <label>Mot de passe</label>
    <input type="password" name="password" required>
    <button type="submit" name="submit" value="doLogin">Me conecté a mon compte</button>
</form>
END;
        return array('html' => $html, 'css' => '', 'title' => 'Connection a un compte');
    }

    private function changeFrom(): array
    {
        $html = <<<END
<form id="register" method="post" action="register/post">
    <label>Mot de passe</label>
    <input type="password" name="password-old" required>
    <label>Nouveau mot de passe</label>
    <input type="password" name="password" required>
    <label>Cofirmé le nouveau mot de passe</label>
    <input type="password" name="password-confirm" required>
    <button type="submit" name="submit" value="doChange">Changé mon mot de pass</button>
</form>
END;
        return array('html' => $html, 'css' => '', 'title' => 'Changement d\'un mot de pass');
    }
}