<?php


namespace mywishlist\controllers;


use mywishlist\models\Liste;
use mywishlist\views\ParticipationView;
use mywishlist\views\ViewsDisplayAllLists;

class ListController
{

    public static function displayAllLists(){
        $list = Liste::all();
        ViewsDisplayAllLists::displayAllLists($list);
    }
}