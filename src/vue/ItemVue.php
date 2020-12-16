<?php


namespace wishlist\vue;


class ItemVue
{


    public function render(){
        $app = \Slim\Slim::getInstance();
        //pas complet
        //$url = $app->urlFor(this->role == OFFREUR ? 'consulter_liste' : 'voir_liste', array('name'))
        $this->html = $this->afficherDetail();
        $this->menu = "<a href= '$url'>Liste {$this->liste->titre}</a>";
        return parent::render();

    }
}