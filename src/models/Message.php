<?php


namespace mywishlist\models;


class Message extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'message_list';
    protected $primaryKey = 'id_message';
    public $timestamps = false;

    public function list() {
        return $this->belongsTo('models\WishList','list_id','no');
    }
}