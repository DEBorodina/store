<?php
include '../vendor/autoload.php';
include '../app/core.php';
$routes = [
    '/' => 'App\\Controllers\\SiteController@index',
    '/catalog' => 'App\\Controllers\\CatalogController@index',
    '/product' => 'App\\Controllers\\CatalogController@showProduct'
];
$runAction = 'App\\Controllers\\SiteController@notFound';
$uri = explode('?',$_SERVER['REQUEST_URI']);
$uri = $uri[0];
foreach ($routes as $route => $action) {
    if ($uri == $route) {
        $runAction = $action;
        break;
    }
}
$runAction = explode('@', $runAction);
$controller = new $runAction[0];
$controller->{$runAction[1]}();