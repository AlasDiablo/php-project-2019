<?php


namespace mywishlist\views;


use mywishlist\utils\Registries;

class UserView implements IView
{

    public function render($code, $data_set): array
    {
        switch ($code)
        {
            case Registries::REGISTER:
                return $this->registerFrom();
                break;
        }
    }


    private function registerFrom(): array
    {
        $html = <<<END
<form id="register" method="post" action="">
    <input type="text" name="username">
    <input type="email" name="email">
    <input type="email" name="email-confirm">
    <input type="password" name="password">
    <input type="password" name="password-confirm">
    <button type="submit" name="submit" value="doRegister">Créer mon compte</button>
</form>
END;
        return array('html' => $html, 'css' => '', 'title' => 'Creation d\'un compte');
    }
}