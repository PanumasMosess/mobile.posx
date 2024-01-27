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
$routes->post('orderMenuPlus', 'OrderController::getMenuScroll');
$routes->post('orderMenuByType', 'OrderController::orderMenuByType');
$routes->get('/getTableDynamic/(:any)', 'OrderController::getTableDynamic/$1');
$routes->get('/orderMenuDetail/(:any)', 'OrderController::orderMenuDetail/$1');
$routes->post('insertCart', 'OrderController::insertCart');  
$routes->post('orderCart', 'OrderController::getOrderCart');   
$routes->post('orderCartUpdate', 'OrderController::orderCartUpdate'); 
$routes->post('orderMenuSearch', 'OrderController::orderMenuSearch');  
$routes->post('orderCustomerInsert', 'OrderController::insertOrderCustomer');
$routes->get('/priceValue/(:any)', 'OrderController::getPriceValue/$1');
$routes->get('/getRecommendMenu/(:any)', 'OrderController::getRecommendMenu/$1');
