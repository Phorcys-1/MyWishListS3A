<?php

namespace wishlist\controleur;

use http\Env\Request;
use wishlist\modele\Liste as Lst;
use wishlist\models\Liste;
use wishlist\vue\ListeVue;
use wishlist\vue\ListeVue as vLst;
use wishlist\modele\Utilisateur as Utl;
use wishlist\modele\Item as Itm;
use wishlist\vue\ItemVue as vItm;



class ListeControleur {

    protected $app;
    protected $user;


    public function __construct() {
        $this->user=Uti::getCurrentUser();
        $this->app = \Slim\Slim::getInstance();
    }

    /**
    * Crée une nouvelle liste et la vu associé
    *
    * @param Request $rq la requête
    * @param Response $rs la réponse
    * @param array $args
    * @return Response vue
    */
    public function newList(Request $rq, Response $rs, array $args) : Response {
        $post = $rq->getParsedBody();
        $titre = filter_var($post['list_title'], FILTER_SANITIZE_STRING) ;
        $description = filter_var($post['list_description'], FILTER_SANITIZE_STRING) ;
        $l = new Liste(titre, $description); $l->save();
        $url_listes = $this->container->router->pathFor('displayAllList') ;

        return $rs->withRedirect($url_listes);
    }

    /**
     * affichage
     */
    function getListe(Request  $rq, Response $rs, array $args){

        $liste = Liste::where('token', '=', $args['tokenPublic'])>first();
        $data['messages'] = $liste->messages()-toArray();
        $data['liste'] = $liste;

        $vue = new ListeVue($data, $this->app );
        return getBody()->write($vue->render(3));
    }

    /**
     * modification
     */
    function editListe(Request $rq, Response $rs, array $args){
        $liste = Liste::where('token', '=', $args['tokenPublic'])>first();

        if (!isset($liste)){
            $this->app->flash->addMessage('Erreur', "La liste n'existe pas");
            return $rs->withRedirect($this->app->router->pathFor('accueil'));
        }
    }

}

