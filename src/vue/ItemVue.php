<?php

namespace wishlist\vue;
/**
 * Class ItemVue
 * @package wishlist\vue
 */
class ItemVue extends Vue {

    protected $liste,$item;

    /**
     *
     * constructeur
     *
     * @param $role
     * @param $liste
     * @param $item
     */
    public function construct($role,$liste,$item){
        $this->item=$item;
        $this->liste=$liste;
        $this->role=$role;
    }


    /**
     *
     * methode pour creer un item
     *
     * @return string
     */

    public static function creeItem(){
        return <<<ez
    <h3>Ajouter un cadeau</h3>h
    <form method='post' action=''>
    <p>Titre: <input type='text' name=""titre></p>
    <p>Description: <input type='text' name='descr'></p>
    <p>Prix: <input type='number' name='prix'></p>
    <input type='submit' value='Ajouter'>
    </form>
    ez;
    }


    /**
     *
     * methode permettant d'afficher l'item
     *
     * @return string
     *
     */
    public function afficherItem(){
        $app = \Slim\Slim::getInstance();
        if($this->role==OFFREUR){
            $url = $app->urlFor('consulter_item', array('name'=>$this->liste->token,'id'=>$this->item->id));
        }
        else{
            $url = $app->urlFor('voir_item', array('name'=>$this->liste->token,'id'=>$this->item->id));
        }
        return <<<ez
    <div><h4><a href="url">{$this->item->nom}</a></h4>
    <p>{$this->item->descrip}</p>
    <p>{$this->item->tarif}€</p>
    </div>
    ez;
    }


    /**
     *
     * methode permettant d'afficher les details de l'item
     *
     * @return string
     */
    public function  afficherItemDetail(){
        $dispo = empty($this->item->acquereur);
        if ($dispo) {
            if ($this->role == OFFREUR) {
                $txt = <<<ez
            <form method='post' action=''>
            <p>Votre nom: <input name="acquereur" type='text'></p>
            <p>Message: <textarea name='message'></textarea></p>
            <input type='submit' value='choisir'>
            </form>
            ez;
            } else {
                $txt = "<p>Ct item n'a pas encore été choisi.</p>";
            }
        }
        else {
            if ($this->role == OFFREUR) {
                $txt = "<p>Cet item a été choisi par {$this->item->acquereur}</p>";
            } else {
                $txt = "<p>Cet item a été choisi !</p>";
            }
        }
        return <<<ez
        <div><h3>{$this->item->nom}</h3>
            <p>{$this->item->descriptif}</p>
        <p>{$this->item->tarif}€</p>
        $txt
        </div>
        ez;
    }


    /**
     *
     * render
     *
     * @return string
     */
    public function render(){
        $app = \Slim\Slim::getInstance();
        $url = $app->urlFor($this->role == OFFREUR ? 'consulter_liste' : 'voir_liste', array('name'=>$this->liste->token));
        $this->html = $this->afficherDetail();
        $this->menu = "<a href= '$url'>Liste {$this->liste->titre}</a>";
        return parent::render();

    }
}