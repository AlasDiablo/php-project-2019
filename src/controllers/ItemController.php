<?php

namespace mywishlist\controllers;

use DateTime;
use mywishlist\models\Item;
use mywishlist\models\Liste;
use mywishlist\utils\Authentication;
use mywishlist\views\GlobalView;
use mywishlist\views\ItemView;
use mywishlist\utils\Selection;

class ItemController
{

    public function allItems() {
        $items = Item::all();
        $v = new ItemView($items, Selection::ALL_ITEM);
        $v->render();
    }

    public function oneItem($id) {
        $id=filter_var($id, FILTER_SANITIZE_SPECIAL_CHARS);
        $l = Item::where('id', '=', $id)->first();
        $v = new ItemView($l, Selection::ID_ITEM);
        $v->render();
    }

    public function ItemCreateForm($token)
    {
        $list = Liste::where('token', '=', $token)->first();
        if (empty($list)) {
            GlobalView::forbidden();
            return;
        }
        $exp = DateTime::createFromFormat('Y-m-d', $list->expiration);
        $now = new DateTime('now');
        if ($exp <= $now) {
            GlobalView::forbidden();
            return;
        }
        if ($list->user_id == Authentication::getUserId()) {
            $v = new ItemView($list, Selection::FORM_CREATE_ITEM);
            $v->render();
        } else {
            GlobalView::forbidden();
        }
    }

    public function createItem($id){
        $i = new Item();
        if($_POST['nom'] != "") {
            $i->nom = filter_var($_POST['nom'], FILTER_SANITIZE_SPECIAL_CHARS);
        }
        if($_POST['description'] != "") {
            $i->descr = filter_var($_POST['description'], FILTER_SANITIZE_SPECIAL_CHARS);
        }
        if($_POST['prix'] != "") {
            $i->tarif = filter_var($_POST['prix'], FILTER_SANITIZE_NUMBER_FLOAT);
        }
        if($_POST['url'] != ""){
            $i->url = filter_var($_POST['url'],FILTER_SANITIZE_URL);
        }
        $i->img = $this->ajoutImage();
        $i->liste_id = filter_var($id,FILTER_SANITIZE_NUMBER_INT);
        $i->save();
        header("Location: /index.php/list/$i->liste_id");
        exit();
    }

    public function ItemManageForm($token, $item){
        $list = Liste::where('token', '=', $token)->first();
        if (!isset($list->no)) {
            $list = Liste::where('tokenPart', '=', $token)->first();
            if(!isset($list->no)) {
                GlobalView::bad_request();
                return;
            }
        }
        $item = Item::where('id', '=', $item)->first();


        $exp = DateTime::createFromFormat('Y-m-d', $list->expiration);
        $now = new DateTime('now');
        if ($exp <= $now) {
            GlobalView::forbidden();
            return;
        }

        if ($token == $list->token) {
            $v = new ItemView($item, Selection::FORM_MODIFY_ITEM_MANAGE);
            $v->render();
        } elseif ($token == $list->tokenPart) {
            $v = new ItemView($item, Selection::FORM_MODIFY_ITEM_PART);
            $v->render();
        } else {
            GlobalView::forbidden();
        }
    }

    public function modifyItem($id){
        $d = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
        $i = Item::where('id', '=', $d)->first();
        if($_POST['nom'] != "") {
            $i->nom = filter_var($_POST['nom'], FILTER_SANITIZE_SPECIAL_CHARS);
        }
        if($_POST['description'] != "") {
            $i->descr = filter_var($_POST['description'], FILTER_SANITIZE_SPECIAL_CHARS);
        }
        if($_POST['prix'] != "") {
            $i->tarif = filter_var($_POST['prix'], FILTER_SANITIZE_NUMBER_FLOAT);
        }
        if($_POST['url'] != ""){
            $i->url = filter_var($_POST['url'],FILTER_SANITIZE_URL);
        }
        $i->img = $this->ajoutImage();
        $i->save();
        header("Location: /index.php/list/$i->liste_id");
        exit();
    }

    public function deleteItem($id){
        $d = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
        $i = Item::where('id', '=', $d)->first();
        $i->delete();
        header("Location: /index.php/list/$i->liste_id");
        exit();
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

    public function reserveItemSubmit($id)
    {

        if (isset($_POST['nom_reserve_item'])){
            $msg = filter_var($_POST['nom_reserve_item'], FILTER_SANITIZE_SPECIAL_CHARS);
            $ri = Item::where('id', '=', $id)->first();
            $ri->msgReserve = $msg;
            $ri->nomReserve = Authentication::getUsername();
            $ri->save();
        } else {
            $v = new ItemView(null, Selection::FORM_ITEM_RESERVE_FAIL);
            $v->render();
            return;
        }
        $v = new ItemView(null, Selection::FORM_ITEM_RESERVE_SUCCESS);
        $v->render();
    }

    public function ajoutImage()
    {
        if (!empty($_FILES["image"]["name"]))
        {
            $targetDir = realpath("uploads");
            $fileName = basename($_FILES["image"]["name"]);
            $targetFilePath = $targetDir . DIRECTORY_SEPARATOR . $fileName;
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
            $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
            if (in_array($fileType, $allowTypes)) {
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
                    return $fileName;
                } else {
                    $v = new ItemView(null, Selection::FORM_IMAGE_UPLOAD_FAIL);
                    $v->render();
                    return;
                }
            } else {
                $v = new ItemView(null, Selection::FORM_ITEM_RESERVE_FAIL);
                $v->render();
                return;
            }
        }
    }
}