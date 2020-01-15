<?php

namespace mywishlist\models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Participant, Modele utilisé pour interagire avec la base de donnée
 * @package mywishlist\models
 */
class Participant extends Model
{
    /**
     * @var string nom de la table dans la bdd
     */
    protected $table = 'participant';

    /**
     * @var string nom de la clé primaire dans la bdd
     */
    protected $primaryKey = 'user_id';

    /**
     * @var bool gestion du temps
     */
    public $timestamps = false;
}