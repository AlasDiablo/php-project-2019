<?php

namespace mywishlist\models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Item, Modele utilisé pour interagire avec la base de donnée
 * @package mywishlist\models
 */
class Item extends Model
{
    /**
     * @var string nom de la table dans la bdd
     */
    protected $table = 'item';

    /**
     * @var string nom de la clé primaire dans la bdd
     */
    protected $primaryKey = 'id';

    /**
     * @var bool gestion du temps
     */
    public $timestamps = false;

    /**
     * Fonction utilisé pour les clé etrengers
     * @return Collection list des clé etrangers
     */
    public function liste_id()
    {
        return $this->hasMany('\models\Liste', 'no')->get();
    }
}