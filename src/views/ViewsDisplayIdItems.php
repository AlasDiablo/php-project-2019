<?php

namespace mywishlist\views;

class ViewsDisplayIdItems
{

    public static function getIdItems($item_by_id) {
        foreach ($item_by_id as $key => $value) {
            print $key . ': <br>';
            print '  id: ' . $value['id'] . '<br>' .
                ' liste_id: ' . $value['liste_id'] . '<br>' .
                ' nom: ' . $value['nom'] . '<br>' .
                ' descr: ' . $value['descr'] . '<br>' .
                ' img: ' . $value['img'] . '<br>' .
                ' url: ' . $value['url'] . '<br>' .
                ' tarif: ' . $value['tarif'] . '<br>';
            print  '<br>';
        }
    }

}