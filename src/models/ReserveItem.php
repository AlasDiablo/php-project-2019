<?php

namespace mywishlist\models;

use Illuminate\Database\Eloquent\Model;

class ReserveItem extends Model {
    protected $table = 'reserveitem';
    protected $primaryKey = 'id';
    public $timestamps = false;
}