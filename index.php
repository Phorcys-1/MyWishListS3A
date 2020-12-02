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

echo 'init'.'<br>';

$db = new DB();
print ("eloquent installé".'<br>');

$db->addConnection([
    'driver' => 'mysql',
    'host' => 'localhost',
    'database' => 'wish',
    'username' => 'wish',
    'passwaord' => '',
    'charset' => 'utf8',
    'collation' => 'utf8_unicode_ci'
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


