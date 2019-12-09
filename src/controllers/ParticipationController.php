<?php


namespace mywishlist\controllers;


use mywishlist\models\Liste;
use mywishlist\models\Item;
use mywishlist\views\RenderHandler;
use mywishlist\utils\Registries;

class ParticipationController
{
    public static function displayAllLists(){

        $list = Liste::all();
        $r = new RenderHandler(Registries::LISTALL, $list);
        $r->render();
    }

    public static function displayAllItems()
    {
        $item = Item::all();
        $r = new RenderHandler(Registries::ITEMALL, $item);
        $r->render();
    }
}