<?php

require_once './vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as DB;
$ini_file = parse_ini_file('src/conf/conf.ini');
$db = new DB();
$db->addConnection([
    'driver'    => $ini_file['driver'],
    'host'      => $ini_file['host'],
    'database'  => $ini_file['database'],
    'username'  => $ini_file['username'],
    'password'  => $ini_file['password'],
    'charset'   => $ini_file['charset'],
    'collation' => $ini_file['charset'] . '_unicode_ci',
    'prefix'    => ''
]);
$db->setAsGlobal();
$db->bootEloquent();

use \Slim\Slim as Slim;
use \mywishlist\controllers\ControllerDisplayIdItems as ControllerDisplayIdItems;
use \mywishlist\controllers\ControllerDisplayAllItems as ControllerDisplayAllItems;
use \mywishlist\controllers\ControllerDisplayAllLists as ControllerDisplayAllLists;


$app = new Slim();

$app->get('/list/display/all', function () {

});

$app->get('/item/display/all', function () {
    ControllerDisplayAllItems::displayAllItems();
});

$app->get('/item/display/:id', function ($id) {
    ControllerDisplayIdItems::getIdItems($id);
});

$app->get('/', function() {
    echo "<!DOCTYPE html>" .
    "<html lang=\"en\">" .
    "<head>" .
        "<meta charset=\"UTF-8\">" .
        "<title>Title</title>" .
    "</head>" .
    "<body>" .
        "<p><a href=\"index.php/item/display/all\">display all items</a></p>" .
        "<p><a href=\"index.php/list/display/all\">display all liste</a></p>" .
    "</body>" .
"</html>";
});

$app->run();

// code a mettre dans des controlleur

/*
RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule ^ index.php [QSA,L]
 */

/*$list = Liste::all();
foreach ($list as $key => $value) {
    print $key . ': <br>';
    print '  no: ' . $value['no'] . '<br>' .
        ' user_id: ' . $value['titre'] . '<br>' .
        ' description: ' . $value['description'] . '<br>' .
        ' expiration: ' . $value['expiration'] . '<br>' .
        ' token: ' . $value['token'] . '<br>';
    print  '<br>';
}

print  '------------------------------------------<br>';

$item = Item::all();
foreach ($item as $key => $value) {
    print $key . ': <br>';
    print '  id: ' . $value['id'] . '<br>' .
        ' liste_id: ' . $value['liste_id'] . '<br>' .
        ' nom: ' . $value['nom'] . '<br>' .
        ' descr: ' . $value['descr'] . '<br>' .
        ' img: ' . $value['img'] . '<br>' .
        ' url: ' . $value['url'] . '<br>' .
        ' tarif: ' . $value['tarif'] . '<br>';
    print  '<br>';
}

print  '------------------------------------------<br>';

$item_by_id = Item::where('id', '=', $_GET['id'])->get();
foreach ($item_by_id as $key => $value) {
    print $key . ': <br>';
    print '  id: ' . $value['id'] . '<br>' .
        ' liste_id: ' . $value['liste_id'] . '<br>' .
        ' nom: ' . $value['nom'] . '<br>' .
        ' descr: ' . $value['descr'] . '<br>' .
        ' img: ' . $value['img'] . '<br>' .
        ' url: ' . $value['url'] . '<br>' .
        ' tarif: ' . $value['tarif'] . '<br>';
    print  '<br>';
}*/
?>


