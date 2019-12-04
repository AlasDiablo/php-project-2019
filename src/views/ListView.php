<?php


namespace mywishlist\views;


class ListView implements IView
{

    public function render($code, $data_set): array
    {
        return array(
            'css' => '',
            'html' => $this->displayAllLists($data_set)
        );
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
}