<?php


namespace wishlist\models;
use Illuminate\Database\Eloquent\Model;


class Liste extends Model {
    protected $table = 'liste';
    protected $primaryKey = 'no';
    pubilc $timestamps = false;


    public function item(){
        return $this->hasMany('\wishlist\models\Item','iste_id');
    }
}