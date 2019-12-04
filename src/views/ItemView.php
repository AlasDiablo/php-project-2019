<?php


namespace mywishlist\views;


class ItemView implements IView
{

    public function render($code, $data_set): string
    {
        // TODO: Implement render() method.
    }

    private function displayAllitems($list){
        foreach ($list as $key => $value) {
            print $key . ': <br>';
            print '  no: ' . $value['no'] . '<br>' .
                ' user_id: ' . $value['titre'] . '<br>' .
                ' description: ' . $value['description'] . '<br>' .
                ' expiration: ' . $value['expiration'] . '<br>' .
                ' token: ' . $value['token'] . '<br>';
            print  '<br>';
        }
    }

    private function getIdItems($item_by_id) {
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