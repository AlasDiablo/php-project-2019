<?php


namespace mywishlist\controllers;
use mywishlist\views\AccueilView;

class IndexController
{
    public function accueil() {
        $v = new AccueilView();
        $v->render();
    }
}