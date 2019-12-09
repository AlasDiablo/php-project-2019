<?php


namespace mywishlist\views;

use mywishlist\utils\Registries;

class ParticipationView implements IView
{
    public function render($code, $data_set): array
    {
        switch ($code) {
            case Registries::LISTALL:
                return array(
                    'css' => '',
                    'html' => $this->displayAllLists($data_set),
                    'title' => "All lists"
                );
                break;
            case Registries::ITEMALL:
                return array(
                    'css' => '',
                    'html' => $this->displayAllItems($data_set),
                    'title' => "All items"
                );
                break;
            default:
                return array(
                    'css' => '',
                    'html' => "<p>404</p>",
                    'title' => "error"
                );
                break;
        }
    }

    private function displayAllLists($list){
        $str = "";
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
}