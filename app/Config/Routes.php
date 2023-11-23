<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');
$routes->get('/home/(:any)', 'OrderController::index');
$routes->get('/details/(:any)', 'OrderController::product_detail/$1');
$routes->get('/orderType/(:any)', 'OrderController::getOrderType/$1');
$routes->get('/orderMenu/(:any)', 'OrderController::getMenu/$1');