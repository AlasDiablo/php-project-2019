<?php

// Import de la class qui a pour but de charger tous les imports du projet
require_once './vendor/autoload.php';

// Liste des tous les imports
use mywishlist\controllers\ParticipationController;
use \mywishlist\controllers\UserController;
use mywishlist\controllers\ListController;
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
    ParticipationController::displayAllLists();
});
$router->get('/item/display/all', function () {
    ParticipationController::displayAllItems();
});
$router->get('/list/display/:id', function ($id) {
    ParticipationController::displayList($id);
});
$router->get('/item/display/:id', function ($id) {
    ParticipationController::displayItem($id);
});
$router->get('/item/reserve/:id', function ($id) {
    ParticipationController::reserveItem($id);
});
$router->get('/item/reserve/submit/:id', function ($id) {
    ParticipationController::reserveItemSubmit($id);
});
$router->get('/list/create/form', function(){
    ListController::formCreateList();
});
$router->post('/list/create/submit', function(){
    ListController::createList();
});
$router->get('/item/reserve/:id', function ($id) {
    ParticipationController::reserveItem($id);
});
$router->post('/item/reserve/submit/', function () {
    ParticipationController::reserveItemSubmit();
});

$router->get(Registries::REGISTER_PATH, function () {
    UserController::register();
})->name(Registries::REGISTER);

$router->post(Registries::REGISTER_POST_PATH, function () {
    UserController::register_post();
})->name(Registries::REGISTER_POST);

$router->get(Registries::LOGIN_PATH, function () {
    UserController::login_display();
})->name(Registries::LOGIN);

$router->get(Registries::LOGIN_POST_PATH, function () {
    UserController::login();
})->name(Registries::LOGIN_POST);

$router->get(Registries::CHANGE_PATH, function () {
    UserController::change_password_display();
})->name(Registries::CHANGE);

$router->get(Registries::CHANGE_POST_PATH, function () {
    UserController::change_password();
})->name(Registries::CHANGE_POST);

// démarrage du routage des urls
$router->run();


