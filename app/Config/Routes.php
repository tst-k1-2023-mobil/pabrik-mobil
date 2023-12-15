<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/login', 'Login::index',['as' => 'login']);
$routes->post('/login', 'Login::login',['as' => 'login_post']);
$routes->get('/api/mobil', 'MobilAPI::index');
$routes->get('/api/queue', 'Queue::index');
$routes->post('/api/order', 'Order::create');
$routes->get('/admin', 'Admin::index',['as' => 'admin']);
$routes->post('/admin', 'Admin::index',['as' => 'admin_post']);