<?php


namespace mywishlist\views;


use mywishlist\utils\Registries;

class RenderHandler
{
    private $code;
    private $object;

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

        $html = <<<END
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        $donnee_css
        <title>Title</title>
    </head>
    <body>
        $donnee_html
    </body> 
</html>
END;
        echo $html;
    }
}