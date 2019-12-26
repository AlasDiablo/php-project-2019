<?php


namespace mywishlist\controllers;


use mywishlist\models\Item;
use mywishlist\utils\Registries;
use mywishlist\views\ItemView;
use mywishlist\views\RenderHandler;

class ItemController
{
    const ALL_ITEM = 'ALL_ITEM';
    const ID_ITEM = 'ID_ITEM';
    const FORM = 'FORM';

    public function allItems() {
        $items = Item::all();
        $v = new ItemView($items, self::ALL_ITEM);
        $v->render();
    }

    public function displayItem($id) {
        $l = Item::where('id', '=', $id)->get();
        $v = new ItemView($l, self::ID_ITEM);
        $v->render();
    }
}