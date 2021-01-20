<?php


namespace wishlist\vue;

/**
 * Class Vue
 * @package wishlist\vue
 */
abstract class Vue {
    protected $html,$menu,$role;


    /**
     * Vue constructor.
     * @param int $role
     */

    public function __construct(int $role){
        $this->role=$role;
    }


    /**
     *
     * render
     *
     * @return string
     */
    public function render(){
        if($this->role == DEMANDEUR){
            $titre="Création de liste de Voeux";
        }else{
            $titre="Participation à une liste de cadeaux";
        }
        return <<<ez
        <!DOCTYPE html>
        <html lang="fr">
        <head>
        <meta charset="utf-8">
        <meta name=""description" content="">
        <meta name="author" content="Ivan Gazeau">
        <title>$titre</title>
        </head>
        <body>
        <h1>$titre</h1>
        <div>{$this->menu}</div>
        {$this->html}
        </body>
        </html>
        ez;
    }
}