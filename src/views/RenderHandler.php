<?php


namespace mywishlist\views;


use mywishlist\utils\Registries;

class RenderHandler
{
    private $code;
    private $object;

    /**
     * RenderHandler constructor.
     * @param $code code corespondant a l'action / page a affiché
     * @param $object objet corespondant a un objet qui doit etre affiché dans la view(c'est juste une class qui contient des donnée)
     */
    function __construct($code, $object)
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
            case Registries::USER:
                $obj = new UserView();
                $content = $obj->render($this->code, $this->object);
                break;
            case Registries::ITEMALL:
            case Registries::ITEM:
                $obj = new ItemView();
                $content = $obj->render($this->code, $this->object);
                break;
            case Registries::LISTALL:
            case Registries::LIST:
                $obj = new ListView();
                $content = $obj->render($this->code, $this->object);
                break;
            case Registries::MESSAGE:
                $obj = new MessageView();
                $content = $obj->render($this->code, $this->object);
                break;
            case Registries::PARTICIPATION:
                $obj = new ParticipationView();
                $content = $obj->render($this->code, $this->object);
                break;
        }

        $donnee_html = $content['html'];
        $donnee_css = $content['css'];
        $titre = $content['title'];

        $html = <<<END
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        $donnee_css
        <title>MyWishList - $titre</title>
    </head>
    <body>
        $donnee_html
    </body> 
</html>
END;
        echo $html;
    }
}