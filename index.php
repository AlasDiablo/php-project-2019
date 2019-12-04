<?php

// Import de la class qui a pour but de charger tous les imports du projet
require_once './vendor/autoload.php';

// Liste des tous les imports
use mywishlist\controllers\ItemController;
use \mywishlist\controllers\ListController;
use \mywishlist\controllers\ControllerParticipation;
use \mywishlist\controllers\UserController;
use \Illuminate\Database\Capsule\Manager as DB;
use \Slim\Slim as Slim;
use \mywishlist\views\RenderHandler;
use \mywishlist\utils\Registries;

// Informations de connexion a la base de données
$ini_file = parse_ini_file('src/conf/conf.ini');

// instance de la base de données
$db = new DB();

// ajout des informations pour se connecter à la base de données
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

// demarage de la basse de donnée
$db->setAsGlobal();
$db->bootEloquent();


// intance de slim qui a pour but de créer le rootage des urls
$router = new Slim();



// route de la racine
$router->get(Registries::ROOT_PATH, function() {
    $render = new RenderHandler(Registries::ROOT, null);
    $render->render();
})->name(Registries::ROOT);


$router->get('/list/display/all', function () {
    ListController::displayAllLists();
});
$router->get('/item/display/all', function () {
    ItemController::displayAllItems();
});


// démarrage du routage des urls
$router->run();


