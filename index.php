<?php

// Import de la class qui a pour but de charger tous les imports du projet
require_once './vendor/autoload.php';

// Liste des tous les imports
use \mywishlist\controllers\UserController;
use \mywishlist\controllers\ListController;
use \mywishlist\controllers\ItemController;
use \mywishlist\views\AccueilView;
use \Illuminate\Database\Capsule\Manager as DB;
use mywishlist\views\GlobalView;
use \Slim\Slim;

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

// demerage d'un session
session_start();

// intance de slim qui a pour but de créer le rootage des urls
$app = new Slim();


/*-----|acceuil|-----*/
$app->get('/', function () {
    $v = new AccueilView();
    $v->render();
});


/*-----|listes|-----*/
$app->get('/list/display/all', function () {
    $c = new ListController();
    $c->allList();
});

$app->get('/list/create', function () {
    $c = new ListController();
    $c->listCreateForm();
});

$app->get('/list/:id', function ($id) {
    $c = new ListController();
    $c->oneList($id);
});

$app->get('/list/:id/delete', function ($id) {
    $c = new ListController();
    $c->deleteList($id);
});

$app->get('/list/:id/modify', function ($id) {
    $c = new ListController();
    $c->listModifyForm($id);
});

$app->post('/list/:id/modify/submit', function ($id) {
    $c = new ListController();
    $c->modifyList($id);
});

$app->post('/list/create/submit', function () {
    $c = new ListController();
    $c->createList();
});

$app->get('/list/:id/addItem', function ($id) {
    $c = new ItemController();
    $c->ItemCreateForm($id);
});

$app->post('/list/:id/addItem/submit', function ($id) {
    $c = new ItemController();
    $c->createItem($id);
});

$app->get('/list/:id/share', function ($id) {
    $c = new ListController();
    $c->share($id);
});



/*-----|items|-----*/
$app->get('/list/:no/item/:id/modify', function ($no, $id) {
    $c = new ItemController();
    $c->ItemModifyForm($id);
});

$app->post('/list/:no/item/:id/modify/submit', function ($no, $id) {
    $c = new ItemController();
    $c->modifyItem($id);
});

$app->get('/list/:no/item/:id/delete', function ($no, $id) {
    $c = new ItemController();
    $c->deleteItem($id);
});

$app->get('/item/display/all', function () {
    $c = new ItemController();
    $c->allItems();
});

$app->get('/item/display/', function () {
    $c = new ItemController();
    $c->oneItem();
});

$app->get('/item/reserve/', function () {
    $c = new ItemController();
    $c->reserveItem();
});

$app->post('/item/reserve/submit/:id', function ($id) {
    $c = new ItemController();
    $c->reserveItemSubmit($id);
});


/*-----|comptes|-----*/
$app->get('/account', function () {
    $c = new UserController();
    $c->account();
});

$app->get('/account/mylists', function () {
    $c = new ListController();
    $c->showMyList();
});

$app->get('/account/edit', function () {
    $c = new UserController();
    $c->accountEdit();
});

$app->post('/account/edit/password', function () {
    $c = new UserController();
    $c->changePassword();
});

$app->post('/account/edit/email', function () {
    $c = new UserController();
    $c->accountEmail();
});

$app->post('/account/edit/delete', function () {
    $c = new UserController();
    $c->accountDelete();
});

$app->get('/account/logout', function () {
    $c = new UserController();
    $c->logout();
});

$app->post('/account/register_post', function () {
    $c = new UserController();
    $c->registerPost();
});

$app->post('/account/login_post', function () {
    $c = new UserController();
    $c->loginPost();
});

$app->get('/account/teapot', function () {
    GlobalView::teapot();
});

$app->run();