<?php

namespace wishlist\controleur;

use http\Env\Request;
use http\Env\Response;
use wishlist\modele\Liste as Lst;
use wishlist\models\Item;
use wishlist\models\Liste;
use wishlist\vue\ListeVue as vLst;
use wishlist\modele\Utilisateur as Utl;
use wishlist\modele\Item as Itm;
use wishlist\vue\ItemVue as vItm;

/**
 * Class ItemControleur
 * @package wishlist\controleur
 */

class ItemControleur {
    protected $liste;

    /**
     * ItemControleur constructor.
     * @param $pName
     * constructeur
     */

    public function __construct($pName){
        $this->liste=Lst::where('token', '-',$pName)->first();
    }

    /**
     * @param Request $rq
     * @param Response $rs
     * @param array $args
     * @return Response
     * methode qui cree un item
     */

    function itemCreation(Request $rq, Response $rs, array $args) : Response{
        $item = new Item();

        $nom=$rq->getParsedBody()['titre'];
        $description=$rq->getParsedBody()['decr'];
        $tarif = $rq->getParsedBody()['prix'];
        $Liste = $args['id'];

        $item->nom = filter_var($nom, FILTER_SANITIZE_STRING);
        $item->descr = filter_var($description, FILTER_SANITIZE_STRING);
        $item->tarif = filter_var($tarif, FILTER_SANITIZE_NUMBER_FLOAT);
        $item->Liste = filter_var($Liste, FILTER_SANITIZE_NUMBER_INT);
        $item->save();

        $rs = $rs->withRedirect($this->liste->token);
        return $rs;
    }

    /**
     * @param Request $rq
     * @param Response $rs
     * @param int $id
     * @return Response
     * methode qui affiche un item selon son id
     */

    function afficherItem(Request $rq, Response $rs,int $id) : Response{
        $item= Item::where('liste_id','-',$this->no)->where('id','-',$id)->first();
        $v = new ItemVue($item, $this->c);
        $rs->getBody()->write($v->render(2));
    }

    /**
     * @param Request $rq
     * @param Response $rs
     * @param int $id
     * @return Response
     * methode qui supprime un item selon son id
     */

    function supprimerItem(Request $rq, Response $rs, int $id): Response {
        $idItem = filter_var($id,FILTER_SANITIZE_NUMBER_INT);
        $item = \mywishlist\model\Item::where('idItem', '=', $idItem)->first();
        $item->delete();

        $rs = $rs->withRedirect($this->liste->token);
        return $rs;
    }
}