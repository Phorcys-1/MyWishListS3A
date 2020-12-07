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

$app = new \Slim\App();

$app->get( '/wishlist/{name}[/]', function(Request $rq, Response $rs, array $args ): Response {
    $name = $args['name'];
    $rs->getBody()->write("<h1>Liste des $name </h1>");
    return $rs;
}
);

$app->get( '/wishlist/list_items', function(Request $rq, Response $rs, array $args ): Response {
    $name = $args['name'];
    $rs->getBody()->write("<h1>Liste des items d'une wishlist $name </h1>");
    return $rs;
}
);

$app->get( '/items_id/{name}[/]', function(Request $rq, Response $rs, array $args ): Response {
    $name = $args['name'];
    $rs->getBody()->write("<h1>Affichage d'un $name </h1>");
    return $rs;
}
);


$app->run();


