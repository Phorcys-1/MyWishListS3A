<?php


namespace wishlist\models;


class Utilisateur extends \Illuminate\Database\Eloquent\Model {


    protected $table = 'utilisateur';
    protected $primaryKey = 'id';
    public $timestamps = false;


    /**
     *
     * methode retournant les utilisateurs courant
     *
     * @return int
     */
    public static function getCurrentUser() {


        return 1;

    }
    

}


