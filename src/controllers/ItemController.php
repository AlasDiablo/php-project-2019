<?php


namespace mywishlist\controllers;


use mywishlist\models\Item;
use mywishlist\views\ViewsDisplayAllItems;
use mywishlist\views\ViewsDisplayIdItems;

class ItemController
{

    private static function displayAllItems()
    {
        $item = Item::all();
        ViewsDisplayAllItems::displayAllItems($item);
    }

    public static function getIdItems($id) {
        $item_by_id = Item::where('id', '=', $id)->get();
        ViewsDisplayIdItems::getIdItems($item_by_id);
    }
}