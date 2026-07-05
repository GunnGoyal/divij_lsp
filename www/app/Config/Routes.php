<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


$routes->get('/', 'Home::landing');
$routes->get('sign-up', 'Auth::signupForm');
$routes->post('sign-up', 'Auth::signup');
$routes->get('sign-in', 'Auth::signinForm');
$routes->post('sign-in', 'Auth::signin');


$routes->get('subjects', 'Subjects::index');
$routes->get('subjects/create', 'Subjects::create');
$routes->post('subjects', 'Subjects::store');
$routes->get('subjects/(:num)', 'Subjects::show/$1');
$routes->get('subjects/(:num)/edit', 'Subjects::edit/$1');


$routes->get('tasks', 'Tasks::index');
$routes->get('tasks/create', 'Tasks::create');
$routes->post('tasks', 'Tasks::store');
$routes->get('tasks/(:num)', 'Tasks::show/$1');
$routes->get('tasks/(:num)/edit', 'Tasks::edit/$1');


$routes->get('summaries', 'Summaries::index');
$routes->get('summaries/create', 'Summaries::create');
$routes->post('summaries', 'Summaries::store');
$routes->get('summaries/(:num)', 'Summaries::show/$1');


$routes->get('profile', 'Profile::index');
$routes->post('profile', 'Profile::update');


$routes->group('', ['filter' => 'auth'], function($routes) {
    $routes->get('home', 'Home::index');
   
});

$routes->group('', ['filter' => 'auth'], function($routes) {
    $routes->get('subjects', 'Subjects::index');
    $routes->get('subjects/create', 'Subjects::create');
    $routes->post('subjects', 'Subjects::store');
    $routes->get('subjects/(:num)', 'Subjects::show/$1');
    $routes->get('subjects/(:num)/edit', 'Subjects::edit/$1');
    $routes->post('subjects/(:num)/update', 'Subjects::update/$1');
    $routes->post('subjects/(:num)/delete', 'Subjects::delete/$1');

    $routes->get('tasks', 'Tasks::index');
    $routes->get('tasks/create', 'Tasks::create');
    $routes->post('tasks', 'Tasks::store');
    $routes->get('tasks/(:num)', 'Tasks::show/$1');
    $routes->get('tasks/(:num)/edit', 'Tasks::edit/$1');
    $routes->post('tasks/(:num)/update', 'Tasks::update/$1');
    $routes->post('tasks/(:num)/delete', 'Tasks::delete/$1');
    $routes->post('tasks/(:num)/toggle', 'Tasks::toggle/$1');

    $routes->get('summaries', 'Summaries::index');
    $routes->get('summaries/create', 'Summaries::create');
    $routes->post('summaries', 'Summaries::store');
    $routes->get('summaries/(:num)', 'Summaries::show/$1');
    $routes->post('summaries/(:num)/delete', 'Summaries::delete/$1');

    $routes->get('profile', 'Profile::index');
    $routes->post('profile', 'Profile::update');
    $routes->post('profile/delete', 'Profile::deleteAccount');

    $routes->post('subjects/(:num)/update', 'Subjects::update/$1');
    $routes->post('subjects/(:num)/delete', 'Subjects::delete/$1');

    $routes->get('tasks/(:num)', 'Tasks::show/$1');
$routes->get('tasks/(:num)/edit', 'Tasks::edit/$1');
$routes->post('tasks/(:num)/update', 'Tasks::update/$1');
$routes->post('tasks/(:num)/delete', 'Tasks::delete/$1');
$routes->post('tasks/(:num)/toggle', 'Tasks::toggle/$1');

    $routes->post('logout', 'Auth::logout');
});