<?php

namespace mywishlist\controllers;

use mywishlist\views\ViewsDisplayAllItems;
use mywishlist\models\Item;

class ControllerDisplayAllItems
{
    public static function displayAllItems()
    {
        $item = Item::all();
        ViewsDisplayAllItems::displayAllItems($item);
    }
}