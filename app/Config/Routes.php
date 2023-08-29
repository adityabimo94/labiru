<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home');
$routes->match(['get', 'post'], '/login', 'Auth::login');
$routes->match(['get', 'post'], '/admin/logout', 'Auth::logout');



$routes->group('admin', ['filter' => 'auth'], static function ($routes) {
    $routes->get('dashboard', 'admin\Dashboard');
    $routes->get('todos', 'admin\Todo');
    $routes->get('todos/create', 'admin\Todo::create');
    $routes->post('todos/store', 'admin\Todo::store');
    $routes->get('todos/edit/(:num)', 'admin\Todo::edit/$1');
    $routes->post('todos/update/(:num)', 'admin\Todo::update/$1');
    $routes->get('todos/delete/(:num)', 'admin\Todo::delete/$1');
});


$routes->set404Override(function() {
    return view('404');
});