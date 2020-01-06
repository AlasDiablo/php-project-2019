<?php

namespace mywishlist\controllers;

use mywishlist\models\Item;
use mywishlist\models\Liste;
use mywishlist\models\Participant;
use mywishlist\models\User;
use mywishlist\utils\Authentication;
use mywishlist\utils\Gravatar;
use mywishlist\utils\Selection;
use mywishlist\views\GlobalView;
use mywishlist\views\ListView;

class ListController {

    public function allList()
    {
        $lists = Liste::all();
        $v = new ListView($lists, Selection::ALL_LIST);
        $v->render();
    }

    public function showMyList()
    {
        if (Authentication::getUserId() != Authentication::ANONYMOUS)
        {
            $mylists = Liste::where('user_id', '=', Authentication::getUserId())->get();
            $participLists = Liste::whereIn('no', Participant::select('no')->where('user_id', '=', Authentication::getUserId())->get())->get();
            $lists = array('myLists' => $mylists, 'participLists' => $participLists);
            (new ListView($lists, Selection::ALL_LIST))->render();
        }
        else
        {
            GlobalView::unauthorized();
        }
    }

    private function getAutohrList($list_id)
    {

        $userOwner = User::where('user_id', '=', Liste::select('user_id')->where('no', '=', $list_id)->first()->user_id)->first();
        $usernameOwner = $userOwner->username;
        $gravatarOwner = Gravatar::getGravatar($userOwner->email);
        $out = array(
            array(
                'username' => $usernameOwner,
                'gravatar' => $gravatarOwner,
                'owner' => true
            )
        );

        $userParticip = User::whereIn('user_id', Participant::select('user_id')->where('no', '=', $list_id)->get())->get();
        foreach ($userParticip as $user)
        {
            $username = $user->username;
            $gravatar = Gravatar::getGravatar($user->email);
            array_push(
                $out,
                array(
                    'username' => $username,
                    'gravatar' => $gravatar,
                    'owner' => false
                )
            );
        }

        return $out;
    }

    public function oneList($id_list)
    {
        $id = filter_var($id_list, FILTER_SANITIZE_SPECIAL_CHARS);
        $items = Item::where('liste_id', '=', $id)->get();

        $authors = $this->getAutohrList($id);

        $l = array(
            'items' => $items,
            'authors' => $authors,
            'title' => Liste::select('titre')->where('no', '=', $id)->first()->titre,
            'desc' => Liste::select('description')->where('no', '=', $id)->first()->description,
            'exp' => Liste::select('expiration')->where('no', '=', $id)->first()->expiration,
            'id' => $id_list
        );

        $v = new ListView($l, Selection::ID_LIST);
        $v->render();
    }

    public function listCreateForm()
    {
        $v = new ListView(null, Selection::FORM_CREATE_LIST);
        $v->render();
    }

    public function createList(){
        $l = new Liste();
        $l->user_id = Authentication::getUserId();
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
        header("Location: /index.php/list/$l->no");
        exit();
    }

    public function listModifyForm($id){
        $no = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
        $l = Liste::where('no', '=', $no)->get();
        $v = new ListView($l, Selection::FORM_MODIFY_LIST);
        $v->render();
    }

    public function modifyList($id){
        $no = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
        $l = Liste::where('no', '=', $no)->get();

        if($_POST['titre'] != "") {
            $l[0]->titre = filter_var($_POST['titre'], FILTER_SANITIZE_SPECIAL_CHARS);
        }
        if($_POST['description'] != "") {
            $l[0]->description = filter_var($_POST['description'], FILTER_SANITIZE_SPECIAL_CHARS);
        }
        if($_POST['date'] != "") {
            $l[0]->expiration = filter_var($_POST['date'], FILTER_SANITIZE_SPECIAL_CHARS);
        }
        $l[0]->save();
    }

    public function deleteList($id){
        $no = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
        $l = Liste::where('no', '=', $no)->get();
        $l[0]->delete();
    }

    public function share($id)
    {
        $no = filter_var($id,FILTER_SANITIZE_SPECIAL_CHARS);
        $l = Liste::where('no', '=', $no)->get();
        if(!isset($l[0]['tokenPart'])){
            $token = bin2hex(random_bytes(16));
            $bool = false;
            while(!$bool) {
                $value = Liste::where('tokenPart', '=', $token)->get();
                if (count($value) == 0) {
                    $bool = true;
                } else {
                    $token = bin2hex(random_bytes(16));
                }
            }
            $l[0]->tokenPart = $token;
            $l[0]->update();
        }
        $v = new ListView($l, Selection::SHARE_LIST);
        $v->render();
    }
}