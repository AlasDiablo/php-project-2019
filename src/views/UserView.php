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
                break;
            case Registries::REGISTER_POST:
                return array('html' => 'you are register');
                break;
            case Registries::REGISTER_POST_FAILED:
                return array('html' => 'Probléme dans la recuperation des donnée saisi');
                break;
            case Registries::REGISTER_POST_EMAIL_FAILED:
                return array('html' => 'L\'email donnée est invalide');
                break;
            case Registries::REGISTER_POST_PASSWORD_FAILED:
                return array('html' => 'Le mot de passe donnée est invalide');
                break;
            case Registries::REGISTER_POST_USER_OR_EMAIL_EXSITE:
                return array('html' => 'l\'email et/ou l\'utilisateur exsite deja');
                break;
        }
    }


    private function registerFrom(): array
    {
        $html = <<<END
<form id="register" method="post" action="https://webetu.iutnc.univ-lorraine.fr/~marcolet3u/php-project/register/post">
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
}