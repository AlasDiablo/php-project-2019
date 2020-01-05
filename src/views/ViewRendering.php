<?php


namespace mywishlist\views;

use mywishlist\utils\Authentication;

class ViewRendering
{

    private static function getTopNav()
    {
        if (Authentication::getUserLevel() == Authentication::ANONYMOUS)
        {
            return <<<NAV
<li><a href="/index.php/list/display/all">Listes</a></li>
<li><a href="/index.php/item/display/all">Items</a></li>
<li><a href="/index.php/account">S'inscrire/Se Connecter</a></li>
NAV;
        } else {
            $username = Authentication::getUsername();
            return <<<NAV
<li><a href="/index.php/account/mylists">Mes liste</a></li>
<li><a href="/index.php/account/edit">Bonjour, $username</a></li>
<li><a href="/index.php/account/logout">Se Deconnecter</a></li>
NAV;
        }
    }

    public static function render(string $body, string $title = "")
    {
        $top_nav = self::getTopNav();
        echo <<<HTML
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>MyWishList$title</title>
    <link href ="/css/style.css" rel="stylesheet">
</head>
<body>
    <header id="header">
        <div id="header-inner">	
            <div id="logo">
                <h1><a href="/index.php">Wish<span>List</span></a></h1>
            </div>
            <div id="top-nav">
                <ul>
                    $top_nav
                </ul>
            </div>
            <div class="clr"></div>
        </div>
    </header>

    $body

    <footer id="footer">
        <div id="footer-inner">
            <p>Copyright - MyWishList Project - Lucas BURTÉ, Pierre MARCOLET, Emilien VISENTINI, Aurélien RETHIERS</p>
            <p><a href="#">Accueil</a> &#124; <a href="#">CGU</a> &#124; <a href="#">CGV</a></p>
            <div class="clr"></div>
        </div>
    </footer>
</body>
</html>
HTML;

    }
}