<?php


namespace mywishlist\controllers;


use mywishlist\models\Liste;
use mywishlist\models\Item;
use mywishlist\models\ReserveItem;
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

    public static function reserveItem($IDitem)
    {
        $item = ReserveItem::select('id', 'nom')->where('id', 'like', $IDitem)->get();
        if(empty($item))
        {
            //item do not exist
            return;
        }
        if(!empty($item[$IDitem]))
        {
            ParticipationController::displayItem($IDitem);
            return;
        }
        //form
        $r = new RenderHandler(Registries::ITEM_REGISTER_FORM, null);
        $r->render();
    }

    public static function reserveItemSubmit($IDitem)
    {
        $ri = new ReserveItem();
        $ri->name = filter_var($_POST['nom_reserve_item'], FILTER_SANITIZE_SPECIAL_CHARS);
        $ri->id = $IDitem;
        $ri->save();
        ParticipationController::displayItem($IDitem);
    }
}