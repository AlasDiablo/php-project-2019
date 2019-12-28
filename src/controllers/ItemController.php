<?php

namespace mywishlist\controllers;

use mywishlist\models\Item;
use mywishlist\models\ReserveItem;
use mywishlist\views\ItemView;
use mywishlist\utils\Selection;

class ItemController
{

    public function allItems() {
        $items = Item::all();
        $v = new ItemView($items, Selection::ALL_ITEM);
        $v->render();
    }

    public function oneItem() {
        $id=filter_var($_GET['id'], FILTER_SANITIZE_SPECIAL_CHARS);
        $l = Item::where('id', '=', $id)->get();
        $v = new ItemView($l, Selection::ID_ITEM);
        $v->render();
    }

    public function reserveItem()
    {
        $IDitem=filter_var($_GET['id'], FILTER_SANITIZE_SPECIAL_CHARS);
        $item = ReserveItem::select('id', 'name')->where('id', 'like', $IDitem)->get();
        if(empty($item[0]['id']))
        {
            $r = new ItemView($item, Selection::FORM_ITEM_RESERVE);
            $r->render();
        }else{
            $l = Item::where('id', '=', $IDitem)->get();
            $v = new ItemView($l, Selection::ID_ITEM);
            $v->render();
        }
    }

    public function reserveItemSubmit()
    {
        $IDitem = filter_var($_POST['id_reserve_item'], FILTER_SANITIZE_SPECIAL_CHARS);
        $name = filter_var($_POST['nom_reserve_item'], FILTER_SANITIZE_SPECIAL_CHARS);
        $item = ReserveItem::select('id', 'name')->where('id', 'like', $IDitem)->get();
        $select = Selection::ID_ITEM;
        if(empty($item[0]['id'])){
            $ri = new ReserveItem();
            $ri->id = $IDitem;
            $ri->name = $name;
            $ri->save();
        }else {
            $select = Selection::FORM_ITEM_RESERVE_FAIL;
        }
        $l = Item::where('id', '=', $IDitem)->get();
        $v = new ItemView($l, $select);
        $v->render();
    }
}