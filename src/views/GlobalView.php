<?php


namespace mywishlist\views;


class GlobalView
{
    public static function forbidden()
    {
        $content = <<<HTML
<div class="error-code">
    <h1>Accès refusé. - Forbidden 403</h1>
    <p>Vous n'avez pas le droit d'être ici</p>  
</div>
HTML;
        header('HTTP/1.1 403 Forbidden', true, 403);
    ViewRendering::render($content, ' - Forbidden');
    }

    public static function unauthorized()
    {
        $content = <<<HTML
<div class="error-code">
    <h1>Vous êtes ? 🤔 - Unauthorized 401</h1>
    <p>Une authentification est nécessaire pour accéder à la ressource.</p>      
</div>
HTML;
        header('HTTP/1.1 401 Unauthorized', true, 401);
        ViewRendering::render($content, ' - Unauthorized');
    }

    public static function bad_request()
    {
        $content = <<<HTML
<div class="error-code">
    <h1>Euh, je n'ai pas trop compris... 🤨 - Bad Request 400</h1>
    <p>La requête est invalide. Vérifez la syntax</p>
</div>
HTML;
        header('HTTP/1.1 400 Bad Request', true, 400);
        ViewRendering::render($content, ' - Bad Request');
    }

    public static function teapot()
    {
        $content = <<<HTML
<div class="error-code">
    <h1>Je suis une théière 🍵 - I'm a teapot 418</h1>
    <p>Malheureusement, je n'ai pas pu préparer le café :(</p> 
</div>
HTML;
        header('HTTP/1.1 418 I’m a teapot', true, 418);
        ViewRendering::render($content, " - I'm a teapot");
    }
}