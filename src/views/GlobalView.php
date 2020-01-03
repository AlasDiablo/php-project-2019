<?php


namespace mywishlist\views;


class GlobalView
{
    public static function forbidden()
    {
        $content = <<<HTML
<h1>Accez refusé. - Forbidden 403</h1>
<p>Vous avais pas le droit d'etres ici</p>
HTML;
        header('HTTP/1.1 403 Forbidden', true, 403);
    ViewRendering::render($content, ' - Forbidden');
    }

    public static function unauthorized()
    {
        $content = <<<HTML
<h1>Vous etes ? 🤔 - Unauthorized 401</h1>
<p>Une authentification est nécessaire pour accéder à la ressource.</p>
HTML;
        header('HTTP/1.1 401 Unauthorized', true, 401);
        ViewRendering::render($content, ' - Unauthorized');
    }

    public static function bad_request()
    {
        $content = <<<HTML
<h1>Euh, j'ai pas trop compris... 🤨 - Bad Request 400</h1>
<p>Une authentification est nécessaire pour accéder à la ressource.</p>
HTML;
        header('HTTP/1.1 400 Bad Request', true, 400);
        ViewRendering::render($content, ' - Bad Request');
    }
}