<?php

namespace mywishlist\controllers;

class ControllerDisplayIdItems
{

    public static function getIdItems($id) {
        $item_by_id = Item::where('id', '=', $id)->get();

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