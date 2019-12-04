<?php


namespace mywishlist\views;


use mywishlist\utils\Registries;

class ItemView implements IView
{

    public function render($code, $data_set): array
    {
        if ($code == Registries::ITEMALL) {
            return array(
                'css' => '',
                'html' => $this->displayAllitems($data_set)
            );
        }
    }

    private function displayAllitems($list){
        $str = '';
        foreach ($list as $key => $value) {
            $str .= $key . ': <br>';
            $str .= '  no: ' . $value['no'] . '<br>' .
                ' user_id: ' . $value['titre'] . '<br>' .
                ' description: ' . $value['description'] . '<br>' .
                ' expiration: ' . $value['expiration'] . '<br>' .
                ' token: ' . $value['token'] . '<br>';
            $str .=  '<br>';
        }
        return $str;
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