<?php
//require_once __DIR__ . '/../vendor/autoload.php';
namespace wishlist\models;

use Illuminate\Database\Eloquent\Model;




class Item extends Model{
    public  $table = 'item';
    protected $primaryKey; //= '' ?
    protected $nom;


    public function __construct($pId, $pNom) {
        /*
        if (!(var_dump($pId) == int && var_dump($pNom) == String)) {
            echo ("Error intégrité des types, obtenu" . var_dump($pId) . ", " . var_dump($pNom) . "voulu int, String");
        } elseif ("$pId already exist" == " ") {
            $this->primaryKey = $pId;
            $this->nom = Item::get($pId);
            echo("Warning id $id already exist with nom = $pNom");
        } else {
            $this->primaryKey = $pId;
            $this->nom = $pNom;
            create sql
        }
         */
    }

    public static function get($pId){
        //return select * where id = $pId
    }

    public function liste(){
        return $this->belongsTo('wishlist\src\modele\Liste', 'liste_id');
    }


}


