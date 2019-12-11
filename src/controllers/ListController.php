<?php


namespace mywishlist\controllers;


use mywishlist\models\Liste;
use mywishlist\utils\Registries;
use mywishlist\views\ParticipationView;
use mywishlist\views\ListView;
use mywishlist\views\RenderHandler;

class ListController
{
    public static function formCreateList(){
        $r = new RenderHandler(Registries::FORMCREATELIST,null);
        $r->render();
    }

    public static function createList(){
        $l = new Liste();
        $l->titre = filter_var($_POST['titre'],FILTER_SANITIZE_SPECIAL_CHARS);
        $l->description = filter_var($_POST['description'],FILTER_SANITIZE_SPECIAL_CHARS);
        $l->expiration = filter_var($_POST['date'],FILTER_SANITIZE_SPECIAL_CHARS);
        $token = bin2hex(random_bytes(16));
        $bool = false;
        while(!bool) {
            $value = Liste::where('token', '=', $token)->get();
            if (isset($value)) {
                $token = bin2hex(random_bytes(16));
            } else {
                $bool = true;
            }
        }
        $l->token = $token;
        $l->save();
    }
}