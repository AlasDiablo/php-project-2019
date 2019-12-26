<?php


namespace mywishlist\controllers;


use mywishlist\models\Liste;
use mywishlist\models\Item;
use mywishlist\models\ReserveItem;
use mywishlist\views\RenderHandler;
use mywishlist\utils\Registries;

class ParticipationController
{
    public static function displayAllLists($rq, $rs, $args)
    {
        $list = Liste::all();
        $v = new ListController($list, ALL_LIST);
        $rs->getBody()->write($v->render());
        return $rs;
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
        if(empty($item[$IDitem]))
        {
            $r = new RenderHandler(Registries::ITEM_REGISTER_FORM, $IDitem);
            $r->render();
            return;
        }
        if(!empty($item[$IDitem]))
        {
            //ParticipationController::displayItem($IDitem);
            /*$r = new RenderHandler(Registries::ITEM_REGISTER_FORM, null);
            $r->render();*/
            return;
        }
        //form
        $r = new RenderHandler(Registries::ROOT, null);
        $r->render();
    }

    public static function reserveItemSubmit()
    {
        $IDitem = filter_var($_POST['id_reserve_item'], FILTER_SANITIZE_SPECIAL_CHARS);
        $name = filter_var($_POST['nom_reserve_item'], FILTER_SANITIZE_SPECIAL_CHARS);
        $ri = new ReserveItem();
        $ri->id = $IDitem;
        $ri->name = $name;
        $ri->save();
        ParticipationController::displayItem($IDitem);
    }
}