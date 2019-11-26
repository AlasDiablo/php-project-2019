<?php

namespace mywishlist\controllers;

class ControllerDisplayAllLists
{
    public static function displayAllLists(){
        $list = Liste::all();
        ViewsDisplayAllLists.displayAllLists();
    }
}