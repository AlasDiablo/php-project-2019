<?php

// Import de la class qui a pour but de charger tous les imports du projet
require_once './vendor/autoload.php';

// Liste des tous les imports
use \mywishlist\controllers\UserController;
use \mywishlist\controllers\ListController;
use \mywishlist\controllers\ItemController;
use \mywishlist\controllers\IndexController;
use \Illuminate\Database\Capsule\Manager as DB;
use \Slim\Slim;

// Informations de connexion a la base de données

// instance de la base de données
$db = new DB();

// ajout des informations pour se connecter à la base de données
$ini_file = parse_ini_file('src/conf/conf.ini');
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
$app = new Slim();



$app->get('/', function () {
    $c = new IndexController();
    $c->accueil();
});

$app->get('/list/display/all', function () {
    $c = new ListController();
    $c->allList();
});

$app->get('/list/display/:id', function ($id) {
    $c = new ListController();
    $c->displayList($id);
});

$app->get('/list/create', function () {
    $c = new ListController();
    $c->listForm();
});


$app->get('/item/display/all', function () {
    $c = new ItemController();
    $c->allItems();
});

$app->get('/item/display/', function () {
    $c = new ItemController();
    $c->displayItem();
});

$app->get('/item/reserve/', function () {
    $c = new ItemController();
    $c->reserveItem();
});

$app->post('/item/reserve/submit/', function () {
    $c = new ItemController();
    $c->reserveItemSubmit();
});


$app->get('/account/register', function () {
    $c = new UserController();
    $c->register();
});


$app->get('/account/login', function () {
    $c = new UserController();
    $c->login();
});

$app->get('/account/logout', function () {
    $c = new UserController();
    $c->logout();
});

$app->post('/list/create/submit', function () {
    $c = new ListController();
    $c->createList();
});

$app->post('/account/register/add', function () {
    $c = new UserController();
    $c->register_post();
});

$app->post('/account/login/submit', function () {
    $c = new UserController();
    $c->login_post();
});


$app->run();


