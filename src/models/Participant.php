<?php


namespace mywishlist\models;


use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    protected $table = 'participant';
    protected $primaryKey = 'user_id';
    public $timestamps = false;
}