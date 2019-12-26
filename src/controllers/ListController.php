<?php


namespace mywishlist\controllers;


use mywishlist\models\Liste;
use mywishlist\utils\Selection;
use mywishlist\views\ParticipationView;
use mywishlist\views\ListView;
use mywishlist\views\RenderHandler;

class ListController {



    public function allList()
    {
        $lists = Liste::all();
        $v = new ListView($lists, Selection::ALL_LIST());
        $v->render();
    }

    public function displayList($id)
    {
        $l = Liste::where('no', '=', $id)->get();
        $v = new ListView($l, Selection::ID_LIST());
        $v->render();
    }

    public function listForm()
    {
        $v = new ListView(null, Selection::FORM());
        $v->render();
    }

    public static function createList(){
        $l = new Liste();
        $l->titre = filter_var($_POST['titre'],FILTER_SANITIZE_SPECIAL_CHARS);
        $l->description = filter_var($_POST['description'],FILTER_SANITIZE_SPECIAL_CHARS);
        $l->expiration = filter_var($_POST['date'],FILTER_SANITIZE_SPECIAL_CHARS);
        $token = bin2hex(random_bytes(16));
        $bool = false;
        while(!$bool) {
            $value = Liste::where('token', '=', $token)->get();
            if (count($value) == 0) {
                $bool = true;
            } else {
                $token = bin2hex(random_bytes(16));
            }
        }
        $l->token = $token;
        $l->save();
    }


/*    public static function formCreateList(){
        $r = new RenderHandler(Registries::FORMCREATELIST,null);
        $r->render();
    }*/

}