<?php


namespace mywishlist\controllers;


use mywishlist\models\Liste;
use mywishlist\models\Item;
use mywishlist\views\RenderHandler;
use mywishlist\utils\Registries;

class ParticipationController
{
    public static function displayAllLists()
    {
        $list = Liste::all();
        $r = new RenderHandler(Registries::LISTALL, $list);
        $r->render();
    }

    public static function displayList($id)
    {
        $list = Liste::select('no', 'user_id', 'titre', 'description', 'expiration', 'token')->where('no', 'like', $id)->get();
        $r = new RenderHandler(Registries::LISTONLY, $list);
        $r->render();
    }

    public static function displayAllItems()
    {
        $item = Item::all();
        $r = new RenderHandler(Registries::ITEMALL, $item);
        $r->render();
    }

    public static function displayItem($id)
    {
        $item = Item::select('id', 'liste_id', 'nom', 'descr', 'img', 'url', 'tarif')->where('id', 'like', $id)->get();
        $r = new RenderHandler(Registries::ITEMONLY, $item);
        $r->render();
    }
}