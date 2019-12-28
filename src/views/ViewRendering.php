<?php


namespace mywishlist\views;

class ViewRendering
{

    public static function render(string $body, string $title = "")
    {
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
                <li><a href="/index.php/list/display/all">Listes</a></li>
                <li><a href="/index.php/item/display/all">Items</a></li>
                <li><a href="/index.php/account/register">S'inscrire/Se Connecter</a></li>
                </ul>
            </div>
            <div class="clr"></div>
        </div>
    </header>

    $body

    <div id="footerblurb">
            <div id="footerblurb-inner">
            
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla tincidunt leo vel orci vestibulum, ut efficitur nibh dapibus. Aenean laoreet a nunc in euismod. Vestibulum consequat nisl dui, at molestie nisl condimentum non. Ut at congue metus. Integer aliquam risus ante, ac dapibus neque dictum id. In lobortis ante dapibus, sodales erat lobortis, cursus mauris. Nullam faucibus lacus ut viverra consequat. Quisque viverra feugiat augue non sollicitudin. Phasellus blandit faucibus dui, ut rhoncus justo.</p>
                
                <div class="clr"></div>
            </div>
        </div>
        <footer id="footer">
            <div id="footer-inner">
                <p>Copyright - MyWishList Project - Lucas BURTÉ, Pierre MARCOLET, Emilien VISENTINI, Aurélien RETHIERS</p>
                <p></p><a href="#">Accueil</a> &#124; <a href="#">CGU</a> &#124; <a href="#">CGV</a></p>
                <div class="clr"></div>
            </div>
        </footer>
    </div>
</body>
</html>
HTML;

    }
}