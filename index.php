<?php
require __DIR__ . '/vendor/autoload.php';

use App\Lib\App;
use App\Lib\Router;
use App\Lib\Request;
use App\Lib\Response;
use App\Controller\Home;
use App\Controller\Admin;
use App\Controller\Books;
use App\Controller\Record;
use App\Controller\Vinyl;
use App\Model\Posts;

Posts::load();

Router::get('/', function () {
    (new Home())->indexAction();
});
Router::get('/admin', function () {
    (new Admin())->indexAction();
});
Router::get('/admin/login', function () {
    (new Admin())->loginAction();
});
Router::get('/admin/new', function () {
    (new Admin())->newAction();
});
Router::get('/admin/list', function () {
    (new Admin())->listAction();
});
Router::get('/books', function () {
    (new Books())->indexAction();
});
Router::get('/record', function () {
    (new Record())->indexAction();
});
Router::get('/vinyl', function () {
    (new Vinyl())->indexAction();
});

App::run();