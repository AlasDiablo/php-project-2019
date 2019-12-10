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
}