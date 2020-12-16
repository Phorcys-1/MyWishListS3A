<?php


namespace wishlist\vue;


class ListeVue extends Vue {
    protected $liste;

    public function __construct($pDemandeur, $pListe) {
        parent::__construct($pDemandeur);
        $this->liste = $pListe;
    }

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

    function afficherListes(){
        $app = \Slim\Slim::getInstance();
        $this->html = "<h2> Choisir une liste de souhait</h2>";
        foreach ($this->liste as $liste){
            $url = $app->urlFor('voir_liste', array('name'->$liste->$token));
            $this->html += <<<ez
                <div><a href="$url">$liste->titre</a></div>
                ez;
        }

    }

}