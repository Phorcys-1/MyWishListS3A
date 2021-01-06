<?php


namespace wishlist\controleur;
use wishlist\models\Utilisateur as Uti;
use wishlist\vue\UtilisateurVue as vUti;

class Utilisateur
{



    public function registerForm() {

        $v = new vUti();
        $v->registerForm();

    }


    public function createUser(string $nom, string $password) {

        $utilisateur = new vUti();
        $utilisateur->nom = $nom;
        $utilisateur->password = password_hash($password, PASSWORD_DEFAULT, ['cost' => 12]);
        $utilisateur->save();
    }


    public function authenticateUser(string $nom, string $password) : Uti{

        $uti = Uti::where('nom', '=', $nom)->first();

        if (! is_null($uti)) {

            if (password_verify($password, $uti->password))
                return $uti;

        }


    }

}