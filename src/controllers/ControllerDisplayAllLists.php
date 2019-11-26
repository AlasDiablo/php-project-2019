<?php

namespace mywishlist\controllers;

use mywishlist\views\ViewsDisplayAllLists;
use mywishlist\models\Liste;

class ControllerDisplayAllLists
{
    public static function displayAllLists(){
        $list = Liste::all();
        ViewsDisplayAllLists::displayAllLists($list);
    }
}