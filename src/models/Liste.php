<?php


namespace wishlist\models;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Liste
 * @package wishlist\models
 */
class Liste extends Model {

    protected $table = 'liste';
    protected $primaryKey = -1; //auto increments set -1
    protected $titre;
    protected $description;
    //user ? user id ?
    public $timestamps = false;


    /**
     * Liste constructor.
     * @param $ptitre
     * @param $pdecription
     */
    public function __construct($ptitre, $pdecription)
    {
        $this->titre = $ptitre;
        $this->description = $pdecription;
    }


    /**
     *
     * item
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function item()
    {
        return $this->hasMany('\wishlist\models\Item', 'iste_id');
    }
}