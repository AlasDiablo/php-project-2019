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
            case Registries::REGISTER:
            case Registries::USER:
                $obj = new UserView();
                $content = $obj->render($this->code, $this->object);
                break;
            case Registries::ITEM:
                $obj = new ItemView();
                $content = $obj->render($this->code, $this->object);
                break;
            case Registries::LIST:
                $obj = new ListView();
                $content = $obj->render($this->code, $this->object);
                break;
            case Registries::MESSAGE:
                $obj = new MessageView();
                $content = $obj->render($this->code, $this->object);
                break;
            case Registries::LISTALL:
            case Registries::ITEMALL:
            case Registries::PARTICIPATION:
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
        $donnee_css
        <title>MyWishList$titre</title>
    </head>
    <body>
        $donnee_html
    </body> 
</html>
END;
        echo $html;
    }
}