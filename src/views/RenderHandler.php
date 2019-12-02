<?php


namespace mywishlist\views;


use mywishlist\utils\Registries;

class RenderHandler
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
            case Registries::ROOT:
                $content = $this->getMenu();
        }


        $html = <<<END
<!DOCTYPE html>
    <html lang=\"en\">
    <head>
        <meta charset=\"UTF-8\">
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