<?php


namespace mywishlist\controllers;

use mywishlist\models\Item;
use mywishlist\models\ReserveItem;
use mywishlist\views\ItemView;

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

    public function displayItem() {
        $id=filter_var($_GET['id'], FILTER_SANITIZE_SPECIAL_CHARS);
        $l = Item::where('id', '=', $id)->get();
        $v = new ItemView($l, self::ID_ITEM);
        $v->render();
    }

    public function reserveItem()
    {
        $IDitem=filter_var($_GET['id'], FILTER_SANITIZE_SPECIAL_CHARS);
        $item = ReserveItem::select('id', 'name')->where('id', 'like', $IDitem)->get();
        if(empty($item[0]['id']))
        {
            $r = new ItemView($item, self::FORM);
            $r->render();
        }else{
            $l = Item::where('id', '=', $IDitem)->get();
            $v = new ItemView($l, self::ID_ITEM);
            $v->render();
        }
    }

    public static function reserveItemSubmit()
    {
        $IDitem = filter_var($_POST['id_reserve_item'], FILTER_SANITIZE_SPECIAL_CHARS);
        $name = filter_var($_POST['nom_reserve_item'], FILTER_SANITIZE_SPECIAL_CHARS);
        $item = ReserveItem::select('id', 'name')->where('id', 'like', $IDitem)->get();
        if(empty($item[0]['id']))
        {
            $ri = new ReserveItem();
            $ri->id = $IDitem;
            $ri->name = $name;
            $ri->save();
        }
        $l = Item::where('id', '=', $IDitem)->get();
        $v = new ItemView($l, self::ID_ITEM);
        $v->render();
    }
}