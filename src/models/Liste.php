<?php

namespace mywishlist\models;

class Liste extends \Illuminate\Database\Eloquent\Model {
    protected $table = 'liste';
    protected $primaryKey = '';
    public $timestamps = false;

    public function no() {
        return $this->belongsTo('\models\Item', 'liste_id')->first();
    }
}