<?php


namespace mywishlist\views;


class RootView implements IView
{

    public function render($code, $data_set): array
    {
        $html = <<<End
<p><a href="index.php/item/display/all">display all items</a></p>
<p><a href="index.php/list/display/all">display all liste</a></p>
End;
        return array(
           'css' => '',
           'html' => $html
        );
    }
}