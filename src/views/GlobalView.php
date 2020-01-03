<?php


namespace mywishlist\views;


class GlobalView
{
    public function forbidden()
    {
        $content = <<<HTML
<h1>Accez refusé - Forbidden</h1>
<p>Vous avais pas le droit d'etres ici</p>
HTML;
    http_response_code(403);
    return $content;
    }

    public function unauthorized()
    {
        $content = <<<HTML
<h1>Accez refusé - Unauthorized</h1>
<p>Une authentification est nécessaire pour accéder à la ressource.</p>
HTML;
        http_response_code(401);
        return $content;
    }
}