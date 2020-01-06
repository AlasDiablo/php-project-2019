<?php

namespace mywishlist\controllers;

use mywishlist\models\Item;
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

    public function ItemCreateForm($id)
    {
        $i = new Item();
        $i->liste_id = filter_var($id,FILTER_SANITIZE_NUMBER_INT);
        $v = new ItemView($i, Selection::FORM_CREATE_ITEM);
        $v->render();
    }

    public function createItem($id){
        $i = new Item();
        $i->nom = filter_var($_POST['nom'],FILTER_SANITIZE_SPECIAL_CHARS);
        $i->descr = filter_var($_POST['description'],FILTER_SANITIZE_SPECIAL_CHARS);
        $i->tarif = filter_var($_POST['prix'],FILTER_SANITIZE_NUMBER_FLOAT);
        if($_POST['url'] != ""){
            $i->url = filter_var($_POST['url'],FILTER_SANITIZE_URL);
        }
        $i->liste_id = filter_var($id,FILTER_SANITIZE_NUMBER_INT);
        $i->save();
    }

    public function ItemModifyForm($id){
        $d = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
        $i = Item::where('id', '=', $d)->get();
        $v = new ItemView($i, Selection::FORM_MODIFY_ITEM);
        $v->render();
    }

    public function modifyItem($id){
        $d = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
        $i = Item::where('id', '=', $d)->get();
        if($_POST['nom'] != "") {
            $i[0]->nom = filter_var($_POST['nom'], FILTER_SANITIZE_SPECIAL_CHARS);
        }
        if($_POST['description'] != "") {
            $i[0]->descr = filter_var($_POST['description'], FILTER_SANITIZE_SPECIAL_CHARS);
        }
        if($_POST['prix'] != "") {
            $i[0]->tarif = filter_var($_POST['prix'], FILTER_SANITIZE_NUMBER_FLOAT);
        }
        if($_POST['url'] != ""){
            $i[0]->url = filter_var($_POST['url'],FILTER_SANITIZE_URL);
        }
        $i[0]->save();
    }

    public function deleteItem($id){
        $d = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
        $i = Item::where('id', '=', $d)->get();
        $i[0]->delete();
    }

    public function reserveItem()
    {
        $IDitem=filter_var($_GET['id'], FILTER_SANITIZE_SPECIAL_CHARS);
        $item = Item::select('id', 'nomReserve')->where('id', 'like', $IDitem)->get();
        if(empty($item[0]['nomReserve']))
        {
            $r = new ItemView(null, Selection::FORM_ITEM_RESERVE);
            $r->render();
        }else{
            $l = Item::where('id', '=', $IDitem)->get();
            $v = new ItemView($l, Selection::ID_ITEM);
            $v->render();
        }
    }

    public function reserveItemSubmit()
    {
        if (isset($_POST['nom_reserve_item'])){ //&& !empty($_FILES["image"]["name"])) {
            $id = filter_var($_GET['id'], FILTER_SANITIZE_SPECIAL_CHARS);
            $name = filter_var($_POST['nom_reserve_item'], FILTER_SANITIZE_SPECIAL_CHARS);
            //$targetDir = "C:\wamp64\www\uploads\\"; // TO-DO : Dégager le chemin absolu
            //$fileName = basename($_FILES["image"]["name"]);
            //$targetFilePath = $targetDir . $fileName;
            //$fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
            //$allowTypes = array('jpg', 'png', 'jpeg', 'gif');
            /*if (in_array($fileType, $allowTypes)) {
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
                    $image = $fileName;
                } else {
                    $v = new ItemView(null, Selection::FORM_ITEM_RESERVE_FAIL);
                    $v->render();
                    return;
                }
            } else {
                $v = new ItemView(null, Selection::FORM_ITEM_RESERVE_FAIL);
                $v->render();
                return;
            }*/
            $ri = Item::where('id', '=', $id)->first();
            $ri->nomReserve = $name;
            //$ri->img = $image;
            $ri->save();
        } else {
            $v = new ItemView(null, Selection::FORM_ITEM_RESERVE_FAIL);
            $v->render();
            return;
        }
        $v = new ItemView(null, Selection::FORM_ITEM_RESERVE_SUCCESS);
        $v->render();
    }
}