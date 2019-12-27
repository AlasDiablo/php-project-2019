<?php

namespace mywishlist\models;

class ReserveItem extends \Illuminate\Database\Eloquent\Model {
    protected $table = 'reserveitem';
    protected $primaryKey = 'id';
    public $timestamps = false;
}