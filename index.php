<?php
/**
 * File:  index.php
 * description: ficindex projet wishlist
 *
 * @author: canals
 */

//phpinfo();

require_once __DIR__ . '/vendor/autoload.php';
use  Illuminate\Database\Capsule\Manager as DB;
use wishlist\models\Item;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

define('DEMANDEUR',1);
define('OFFREUR',0);

echo 'init'.'<br>';

$db = new DB();
print ("eloquent installé".'<br>');

$db->addConnection([
    'driver' => 'mysql',
    'host' => 'root',
    'database' => 'wish',
    'username' => 'wish',
    'passwaord' => 'root',
    'charset' => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => ''
]);

$db->setAsGlobal();
$db->bootEloquent();
print ("connécté a la base".'<br>');

//$q1 = Ville::select( 'id', 'nom', 'population')  ->where( 'nom', 'like', 'vand%') ;
//$q1 = $q1->orderBy('population');
//$q2 = Club::where( 'id', '=', 12 );

//$q1 = Item::select( 'id', 'nom')  ->where( 'nom', 'like', 'C%') ;
//echo $q1->get().'<br>';

$items = wishlist\models\item::all();
foreach ($items as $item){
    print $item->id.' '.$item->nom.'<br>';
}

$app = new \Slim\App();

$app->get('/', PageControleur::class.':index')->setName('accueil');

use wishlist\controleur\ListeControleur as Lc;
//Routes listes
$app->get('/liste/c/create', Lc::class.':createListe')->setName('Creation_liste');
$app->post('/liste/c/create', Lc::class.':insertListe')->setName('Insertion_liste');
$app->get('/liste/{tokenPublic:[a-zA-Z0-9]+}', Lc::class.':getListe')->setName('Affichage_liste');
//Suppression liste ? TODO
$app->get('/liste/{tokenPublic:[a-zA-Z0-9]+}/edit/{tokenPrivate:[a-zA-Z0-9]+}', Lc::class.':editListe')->setName('Edition_liste');
$app->post('/liste/{tokenPublic:[a-zA-Z0-9]+}/edit/{tokenPrivate:[a-zA-Z0-9]+}', Lc::class.':updateListe')->setName('Modification_liste');
$app->post('/liste/{tokenPublic:[a-zA-Z0-9]+}/addMessage', Lc::class.':addMessage')->setName('Ajout_description');


use wishlist\controleur\ItemControleur as Ic;
//Routes Articles
$app->get('/liste/{tokenPublic:[a-zA-Z0-9]+}/edit/{tokenPrivate:[a-zA-Z0-9]+}/item/add', Ic::class.':createItem')->setName('Creation_article');
$app->post('/liste/{tokenPublic:[a-zA-Z0-9]+}/edit/{tokenPrivate:[a-zA-Z0-9]+}/item/add', Ic::class.':insertItem')->setName('Insertion_article');
$app->get('/liste/{tokenPublic:[a-zA-Z0-9]+}/item/{idItem:[0-9]+}', Ic::class.':getItem')->setName('Affichage_article');
$app->post('/liste/{tokenPublic:[a-zA-Z0-9]+}/item/{idItem:[0-9]+}/reserve', Ic::class.':reserverItem')->setName('Reservation_article');
$app->get('/liste/{tokenPublic:[a-zA-Z0-9]+}/edit/{tokenPrivate:[a-zA-Z0-9]+}/item/{idItem:[0-9]+}/delete', Ic::class.':deleteItem')->setName('Suppression_Article');
$app->get('/liste/{tokenPublic:[a-zA-Z0-9]+}/edit/{tokenPrivate:[a-zA-Z0-9]+}/item/{idItem:[0-9]+}/edit', Ic::class.':editItem')->setName('Edition_article');
$app->post('/liste/{tokenPublic:[a-zA-Z0-9]+}/edit/{tokenPrivate:[a-zA-Z0-9]+}/item/{idItem:[0-9]+}/edit', Ic::class.':updateItem')->setName('Modification_article');


$app->run();


