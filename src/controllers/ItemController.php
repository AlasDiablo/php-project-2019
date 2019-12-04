<?php


namespace mywishlist\controllers;


use mywishlist\models\Item;
use mywishlist\utils\Registries;
use mywishlist\views\RenderHandler;

class ItemController
{

    public static function displayAllItems()
    {
        $item = Item::all();
        $r = new RenderHandler(Registries::ITEMALL, $item);
        $r->render();
    }

    public static function getIdItems($id) {
        $item_by_id = Item::where('id', '=', $id)->get();
        ViewsDisplayIdItems::getIdItems($item_by_id);
    }
}