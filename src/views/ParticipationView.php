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
            case Registries::LISTONLY:
                return array(
                    'css' => '',
                    'html' => $this->displayList($data_set),
                    'title' => "All lists"
                );
                break;
            case Registries::ITEMONLY:
                return array(
                    'css' => '',
                    'html' => $this->displayItem($data_set),
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

    private function displayAllItems($list){
        $str = '';
        foreach ($list as $key => $value) {
            $str .= $key . ': <br>';
            $str .= 'id de liste: ' . $value['liste_id'] . '<br>' .
                ' nom: ' . $value['nom'] . '<br>' .
                ' description: ' . $value['descr'] . '<br>' .
                ' image: ' . $value['img'] . '<br>' .
                ' url: ' . $value['url'] . '<br>';
                ' tarif: ' . $value['tarif'] . '<br>';
            $str .=  '<br>';
        }
        return $str;
    }

    private function displayList($list){
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

    private function displayItem($list){
        $str = '';
        foreach ($list as $key => $value) {
            $str .= $key . ': <br>';
            $str .= 'id de liste: ' . $value['liste_id'] . '<br>' .
                ' nom: ' . $value['nom'] . '<br>' .
                ' description: ' . $value['descr'] . '<br>' .
                ' image: ' . $value['img'] . '<br>' .
                ' url: ' . $value['url'] . '<br>';
                ' tarif: ' . $value['tarif'] . '<br>';
            $str .=  '<br>';
        }
        return $str;
    }
}