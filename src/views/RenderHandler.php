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
            case Registries::PARTICIPATION:
                $obj = new ParticipationView();
                $content = $obj->render($this->code, $this->object);
                break;
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


    private function getMenu()
    {
        $html = <<<END
<p><a href="index.php/item/display/all">display all items</a></p>
<p><a href="index.php/list/display/all">display all liste</a></p>
END;
        return $html;
    }
}