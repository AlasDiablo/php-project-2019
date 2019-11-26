<?php

namespace mywishlist\controllers;

class ControllerDisplayIdItems
{

    public static function getIdItems($id) {
        $item_by_id = Item::where('id', '=', $id)->get();
        ViewsDisplayIdItems::getIdItems($item_by_id);
    }
}