<?php


namespace wishlist\controleur;
use wishlist\models\Utilisateur as Uti;
use wishlist\models\Item as Itm;
use wishlist\models\Liste as Lst;
use wishlist\vue\ItemVue as VItm;
use wishlist\vue\ListeVue as VLst;


class Offreur
{

    public function afficherListe(string $name) {

        $liste=Lst::where('token', '=',$name)->first();
        $aff = new VLst(OFFREUR,$liste);
        $aff->afficherListes();
        echo $aff->render();
    }

    public function afficherItem(string $name,int $id) {

        $liste=Lst::where('token','=',$name)->first;
        $item=Itm::where('liste_id','=',$liste->no)->where('id','=',$id)->first();
        $aff=new VItm(OFFREUR, $liste, $item);
        echo $aff->render();

    }

    public function acquerirItem(string $name,int $id) {

        $liste=Lst::where('token','=', $name)->first();
        $item=Itm::where('liste','=',$liste->no)->where('id','=',$id)->first();

        if(empty($item->acqeureur)) {

            $app = \Slim\Slim::getInstance();
            $item->acquereur=$app->request->post('acquereur');
            $item->message=$app->request->post('message');
            $item->save();
            $this->afficherListe($name);


        }



    }


}