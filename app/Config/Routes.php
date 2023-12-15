<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/login', 'Login::index');
$routes->get('/register', 'Register::index');
$routes->get('/api/mobil', 'MobilAPI::index');
$routes->get('/api/queue', 'Queue::index');
$routes->post('/api/order', 'Order::create');
$routes->get('/admin', 'Admin::index');
$routes->post('/admin', 'Admin::index');
$routes->get('/listmobil', 'ListMobil::index');
