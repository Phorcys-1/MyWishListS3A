<?php

namespace wishlist\vue;

use wishlist\models\Item;

/**
 * Class ListeVue
 * @package wishlist\vue
 */
class ListeVue extends Vue {
    protected $liste;


    /**
     * ListeVue constructor.
     * @param $pDemandeur
     * @param $pListe
     */
    public function __construct($pDemandeur, $pListe) {
        parent::__construct($pDemandeur);
        $this->liste = $pListe;
    }

    /**
     * methode permettant de creer une liste
     */
    function creerListe(){
        $this->html = <<<ez
            <h3>Commencer votre propre lilste de souhait</h3>
            <form method="post" action="">
            <p>Titre : <input type ='text' name="titre"></p>
            <p>Expire : <input type ='date' name="expire"></p>
            <input type ='submit' name="Créer>
            </form>
            ez;
    }


    /**
     *
     * methode pour afficher les listes
     */
    function afficherListes(){
        $app = \Slim\Slim::getInstance();
        $this->html = "<h2>Choisir une liste de souhait</h2>";
        foreach($this->liste as $liste){
            $url = $app->urlFor('voir_liste', array('name'=>$liste->$token));
            $this->html .= <<<ez
                <div><a href="$url">$liste->titre</a></div>
                ez;
        }
        $url2 = $app->urlFor('nouvelle_liste',array());
        $this->html .= <<<ez
        <a href="$url2">Créer une nouvelle liste</a>
        ez;
    }


    /**
     *
     * Methode d'affichage des nouveaux items
     *
     */
    public function afficherListeNvItem(){
        $this->html = "<h2>{$this->liste->titre}</h2>";
        $this->html .=Item::creerItem();
    }

    /**
     *
     * methode d'affichage
     *
     */
    public function afficherListe(){
        $app = \Slim\Slim::getInstance();
        $this->html = "<h2>{$this->liste->titre}</h2>";
        foreach($this->liste->items as $item){
            $i=new Item($this->role,$this->liste,$item);
            $this->html .= $i->afficherItem();
        }
    }

}