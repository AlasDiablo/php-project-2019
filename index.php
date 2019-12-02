<?php

// Import de la class qui a pour but de chargé tous les import du projet
require_once './vendor/autoload.php';

// Liste des tous les import
use \mywishlist\controllers\ControllerDisplayIdItems;
use \mywishlist\controllers\ControllerDisplayAllItems;
use \mywishlist\controllers\ControllerDisplayAllLists;
use \Illuminate\Database\Capsule\Manager as DB;
use \Slim\Slim as Slim;
use \mywishlist\views\RenderHandler;
use \mywishlist\utils\Registries;

// information de connection a la base de donnée
$ini_file = parse_ini_file('src/conf/conf.ini');

// instance a la base de donnée
$db = new DB();

// ajour des information pour se connecté a la base de donnée
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


// intance de slim qui a pour but de faire le rootage de des url
$app = new Slim();

// route de la racine
$app->get('/', function() {
    $render = new RenderHandler(Registries::ROOT);
    $render->render();
})->name(Registries::ROOT);

$app->get('/list/display/all', function () {
    ControllerDisplayAllLists::displayAllLists();
});

$app->get('/item/display/all', function () {
    ControllerDisplayAllItems::displayAllItems();
});

$app->get('/item/display/:id', function ($id) {
    ControllerDisplayIdItems::getIdItems($id);
});

// demarage du routage des url
$app->run();


