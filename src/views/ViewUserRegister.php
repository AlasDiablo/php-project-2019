<?php


namespace mywishlist\views;


use mywishlist\utils\Registries;

class ViewUserRegister
{
    private $code;

    function __construct($code)
    {
        $this->code = $code;
    }

    public function render()
    {
        $content = "";
        switch ($this->code)
        {
            case Registries::REGISTER:
                $content = $this->register();
        }


        $html = <<<END
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Title</title>
    </head>
    <body>
        $content
    </body> 
</html>
END;
        echo $html;
    }

    private function register()
    {
        return <<<END
<form action="register/post" method="post">
    <p>Votre email : <input type="email" name="email" /></p>
    <p>Votre mot de passe : <input type="password" name="password" /></p>
    <p><input type="submit" value="OK"></p>
</form>
END;
    }
}