<?php


namespace mywishlist\views;


use mywishlist\utils\Registries;

class RenderHandler
{
    private $code;
    private $object;

    /**
     * RenderHandler constructor.
     * @param string $code code corespondant a l'action / page a affiché
     * @param object $object objet corespondant a un objet qui doit etre affiché dans la view(c'est juste une class qui contient des donnée)
     */
    function __construct(string $code, $object)
    {
        $this->code = $code;
        $this->object = $object;
    }

    public function render()
    {
        $content = "";
        switch ($this->code)
        {
            case Registries::ROOT:
                $obj = new RootView();
                $content = $obj->render($this->code, $this->object);
                break;
            case Registries::REGISTER_POST:
            case Registries::REGISTER_POST_USER_OR_EMAIL_EXSITE:
            case Registries::REGISTER_POST_PASSWORD_FAILED:
            case Registries::REGISTER_POST_EMAIL_FAILED:
            case Registries::REGISTER_POST_FAILED:
            case Registries::REGISTER:
            case Registries::USER:
            case Registries::LOGIN_POST:
            case Registries::LOGIN:
            case Registries::LOGIN_FAILD:
            case Registries::LOGIN_BAD_USER:
            case Registries::LOGIN_BAD_PASSWORD:
            case Registries::CHANGE:
            case Registries::CHANGE_POST:
            case Registries::CHANGE_USER_ERROR:
            case Registries::CHANGE_FAILD:
            case Registries::CHANGE_BAD_PASSWORD:
                $obj = new UserView();
                $content = $obj->render($this->code, $this->object);
                break;
            case Registries::ITEM:
                $obj = new ItemView();
                $content = $obj->render($this->code, $this->object);
                break;
            case Registries::LIST:
            case Registries::FORMCREATELIST:
                $obj = new ListView();
                $content = $obj->render($this->code, $this->object);
                break;
            case Registries::MESSAGE:
                $obj = new MessageView();
                $content = $obj->render($this->code, $this->object);
                break;
            case Registries::LISTALL:
            case Registries::ITEMALL:
            case Registries::LISTONLY:
            case Registries::ITEMONLY:
            case Registries::PARTICIPATION:
            case Registries::ITEM_REGISTER_FORM:
                $obj = new ParticipationView();
                $content = $obj->render($this->code, $this->object);
                break;
        }

        $donnee_html = $content['html'];

        if (isset($content['css'])) {
            $donnee_css = $content['css'];
        } else {
            $donnee_css = '';
        }

        if (isset($content['title'])) {
            $titre = ' - ' . $content['title'];
        } else {
            $titre = '';
        }

        $html = <<<END
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="https://webetu.iutnc.univ-lorraine.fr/~marcolet3u/php-project/css/default.css">
    $donnee_css
    <title>MyWishList$titre</title>
</head>
    <body>
        <div class="top">
            <a href="/">Accueil</a>
            <a href="">Liste</a>
            <a href="">Item</a>
            <a href="index.php/user/register">Inscription</a>
            <a href="">Connexion</a>
        </div>
        <div class="principal">
            $donnee_html
        </div>
    </body>
</html>
END;
        echo $html;
    }
}