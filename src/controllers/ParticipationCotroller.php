<?php


namespace mywishlist\controllers;


use mywishlist\models\Liste;
use mywishlist\views\ParticipationView;

class Participation
{
    public static function affichageListe()
    {
        $list = Liste::all();
        $render = new ParticipationView($list);
        echo $render->render(1);
    }
}