<?php

namespace mywishlist\controllers;

use mywishlist\views\ViewsDisplayAllItems;

class ControllerDisplayAllItems
{
    static function displayAllItems()
    {
        $item = Item::all();
        ViewsDisplayAllItems.displayAllItems($item);
    }
}