<?php

namespace mywishlist\models;

use Illuminate\Database\Eloquent\Model;

class Liste extends Model {
    protected $table = 'liste';
    protected $primaryKey = 'no';
    public $timestamps = false;

    public function no() {
        return $this->belongsTo('\models\Item', 'liste_id')->first();
    }

    public function messages() {
        return $this->hasMany('\models\Message', 'list_id');
    }
}