<?php


namespace mywishlist\views;


class RootView implements IView
{

    public function render($code, $data_set): array
    {
        $html = <<<End
<p><a href="https://webetu.iutnc.univ-lorraine.fr/~marcolet3u/php-project/index.php/item/display/all">display all items</a></p>
<p><a href="https://webetu.iutnc.univ-lorraine.fr/~marcolet3u/php-project/index.php/list/display/all">display all liste</a></p>
<p><a href="https://webetu.iutnc.univ-lorraine.fr/~marcolet3u/php-project/index.php/user/register">créer un compte</a></p>
End;
        return array(
           'css' => '',
           'html' => $html,
           'title' => 'Acceuil'
        );
    }
}