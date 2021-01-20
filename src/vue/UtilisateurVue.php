<?php


namespace wishlist\vue;


class UtilisateurVue {


    /**
     *
     * methode de formulaire
     *
     */
    public function registerForm(){
        echo <<<eze
        <h3>Enregistrez-vous</h3>
        <form action ="" method = "post">
        Nom : <input type="text" name="nom">
        <p>Password : <input type="password" name="password"></p>
        <input type="submit" name="i" value="S'inscrire">
        </form>
        eze;
    }
}