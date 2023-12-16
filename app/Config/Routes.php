<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Admin::index');
$routes->post('/', 'Admin::index');
$routes->get('/api/mobil', 'MobilAPI::index');
$routes->get('/api/mobil/(:num)', 'MobilAPI::index/$1');
$routes->get('/api/queue', 'Queue::index');
$routes->post('/api/order', 'Order::create');
