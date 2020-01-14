<?php

// Import de la class qui a pour but de charger tous les imports du projet
require_once './vendor/autoload.php';

// Liste des tous les imports
use \mywishlist\controllers\UserController;
use \mywishlist\controllers\ListController;
use \mywishlist\controllers\ItemController;
use mywishlist\utils\PathsNames;
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


/*-----|accueil|-----*/
$app->get('/', function () {
    $v = new AccueilView();
    $v->render();
})->name('accueil');


/*-----|listes|-----*/
$app->get('/list/create', function () {
    $c = new ListController();
    $c->listCreateForm();
})->name('listcreate');

$app->get('/list/:token', function ($token) {
    $c = new ListController();
    $c->oneList($token);
})->name('list');

$app->get('/list/:id/delete', function ($id) {
    $c = new ListController();
    $c->deleteList($id);
})->name('listDel');

$app->get('/list/:id/modify', function ($id) {
    $c = new ListController();
    $c->listModifyForm($id);
})->name('listMod');

$app->post('/list/:id/modify/submit', function ($id) {
    $c = new ListController();
    $c->modifyList($id);
})->name('listModP');

$app->post('/list/create/submit', function () {
    $c = new ListController();
    $c->createList();
})->name('listCreateP');

$app->get('/list/:id/addItem', function ($id) {
    $c = new ItemController();
    $c->ItemCreateForm($id);
})->name('listAddItem');

$app->post('/list/:id/addItem/submit', function ($id) {
    $c = new ItemController();
    $c->createItem($id);
})->name('listAddItemP');

$app->get('/list/:id/share', function ($id) {
    $c = new ListController();
    $c->share($id);
})->name('listShare');
$app->get('/list/:id/:token', function ($id, $token) {
    $c = new ListController();
    $c->oneList($id);
})->name('listToken');



/*-----|items|-----*/
$app->get('/list/:no/item/:id/modify', function ($no, $id) {
    $c = new ItemController();
    $c->ItemModifyForm($id);
})->name('modifyItemFromList');

$app->post('/list/:no/item/:id/modify/submit', function ($no, $id) {
    $c = new ItemController();
    $c->modifyItem($id);
})->name('modifyItemFromListP');

$app->get('/list/:no/item/:id/delete', function ($no, $id) {
    $c = new ItemController();
    $c->deleteItem($id);
})->name('deleteItemFromList');

$app->get('/item/all', function () {
    $c = new ItemController();
    $c->allItems();
})->name('items');

$app->get('/item/:id', function ($id) {
    $c = new ItemController();
    $c->oneItem($id);
})->name('item');

$app->get('/item/reserve/', function () {
    $c = new ItemController();
    $c->reserveItem();
})->name('reserveItem');

$app->post('/item/reserve/submit/:id', function ($id) {
    $c = new ItemController();
    $c->reserveItemSubmit($id);
})->name('reserveItemP');

$app->post('/item/upload/submit/:id', function ($id) {
    $c = new ItemController();
    $c->ajoutImage($id);
})->name('imageUploadP');


/*-----|comptes|-----*/
$app->get('/account', function () {
    $c = new UserController();
    $c->account();
})->name('account');

$app->get('/account/mylists', function () {
    $c = new ListController();
    $c->showMyList();
})->name('accountLists');

$app->get('/account/edit', function () {
    $c = new UserController();
    $c->accountEdit();
})->name('accountEdit');

$app->post('/account/edit/password', function () {
    $c = new UserController();
    $c->changePassword();
})->name('accountEditPassP');

$app->post('/account/edit/email', function () {
    $c = new UserController();
    $c->accountEmail();
})->name('accountEditEmailP');

$app->post('/account/edit/delete', function () {
    $c = new UserController();
    $c->accountDelete();
})->name('accountDelP');

$app->get('/account/logout', function () {
    $c = new UserController();
    $c->logout();
})->name('accountLogout');

$app->post('/account/register_post', function () {
    $c = new UserController();
    $c->registerPost();
})->name('accountRegisterP');

$app->post('/account/login_post', function () {
    $c = new UserController();
    $c->loginPost();
})->name('accountLoginP');

$app->get('/account/teapot', function () {
    GlobalView::teapot();
})->name('teapot');

$app->run();