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

use \mywishlist\models\Liste as Liste;
use \mywishlist\models\Item as Item;

$list = Liste::all();
foreach ($list as $key => $value) {
    print $key . ': <br>';
    print '  no: ' . $value['no'] . '<br>' .
        ' user_id: ' . $value['titre'] . '<br>' .
        ' description: ' . $value['description'] . '<br>' .
        ' expiration: ' . $value['expiration'] . '<br>' .
        ' token: ' . $value['token'] . '<br>';
    print  '<br>';
}

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