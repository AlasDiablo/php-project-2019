<?php


namespace mywishlist\controllers;


use mywishlist\models\Liste;
use mywishlist\utils\Registries;
use mywishlist\views\ParticipationView;
use mywishlist\views\ListView;
use mywishlist\views\RenderHandler;

class ListController
{

    public static function displayAllLists(){

        $list = Liste::all();
        $r = new RenderHandler(Registries::LISTALL, $list);
        $r->render();
    }
}