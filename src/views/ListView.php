<?php


namespace mywishlist\views;


class ListView implements IView
{

    public function render($code, $data_set): string
    {
        // TODO: Implement render() method.
    }

    private function displayAllLists($list){
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
}