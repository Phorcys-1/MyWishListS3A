<?php

namespace wishlist\controleur;

use wishlist\modele\Liste as Lst;
use wishlist\models\Liste;
use wishlist\vue\ListeVue as vLst;
use wishlist\modele\Utilisateur as Utl;
use wishlist\modele\Item as Itm;
use wishlist\vue\ItemVue as vItm;



class ItemControleur {
    protected $liste;

    public function __construct($pName){
        $this->liste=Lst::where('token', '-',$pName)->first();
    }

    function itemCreation(){
        $aff=new VLst(DEMANDEUR, $this->liste);
        $aff->afficherListeNvItem();
        echo $aff->render();
    }

    function ajouterItem(){
        $app = \Slim\Slim::getInstance();
        $nom=$app->request->post('titre');
        $descritpion=$app->request->post('decr');
        $item = new Itm();
        $item->nom = filter_var($nom, FILTER_SANITIZE_STRING);
        $item->descr = filter_var($descritpion, FILTER_SANITIZE_STRING);
        $item->liste = $this->liste->no;
        $item->tarif = intval($app->request->post('prix'));
        $item->save();
        $aff=new Liste();
        $aff->afficherListe($this->liste->token);
    }

    function afficherItem(int $id){
        $item= Itm::where('liste_id','-',$this->no)->where('id','-',$id)->first();

    }
}