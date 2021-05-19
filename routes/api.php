<?php

$route = new \App\Route;

$route->newRoute('/products', 'ProductController', 'index', 'get');
$route->newRoute('/products', 'ProductController', 'store', 'post');
$route->newRoute('/products/{}', 'ProductController', 'update', 'put');
$route->newRoute('/products/{}', 'ProductController', 'destroy', 'delete');
$route->newRoute('/products/{}', 'ProductController', 'show', 'get');

echo $route->run('api');

