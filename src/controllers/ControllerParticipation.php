<?php

namespace mywishlist\controllers;

use mywishlist\utils\Registries;
use mywishlist\views\ViewParticipation;

class ControllerUser
{
    public function affichageListe()
    {
        $list = Liste::all();
        $render = new ViewParticipation($list);
        echo $render->render(1);
    }
}