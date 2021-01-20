<?php


namespace wishlist\controleur;
use wishlist\models\Utilisateur as Uti;
use wishlist\vue\UtilisateurVue as vUti;


/**
 * Class Utilisateur
 * @package wishlist\controleur
 */
class Utilisateur
{


    /**
     * methode pour le formulaire d'inscription
     */
    public function registerForm() {

        $v = new vUti();
        $v->registerForm();

    }

    /**
     *
     * methode pour creer un utilisateur
     *
     * @param string $nom
     * @param string $password
     */
    public function createUser(string $nom, string $password) {

        $utilisateur = new vUti();
        $utilisateur->nom = $nom;
        $utilisateur->password = password_hash($password, PASSWORD_DEFAULT, ['cost' => 12]);
        $utilisateur->save();
    }

    /**
     *
     * methode pour authentifier l'utilisateur
     *
     * @param string $nom
     * @param string $password
     * @return Uti
     */
    public function authenticateUser(string $nom, string $password) : Uti{

        $uti = Uti::where('nom', '=', $nom)->first();

        if (! is_null($uti)) {

            if (password_verify($password, $uti->password))
                return $uti;

        }


    }

}