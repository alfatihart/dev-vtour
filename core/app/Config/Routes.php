<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/login', 'Auth::loginForm', ['as' => 'admin.login.form']);
$routes->post('/login', 'Auth::loginHandler', ['as' => 'admin.login.handler']);
$routes->get('/register', 'Auth::registerForm', ['as' => 'admin.register.handler']);
$routes->post('/register', 'Auth::registerHandler', ['as' => 'admin.register.handler']);
// $routes->get('/login', 'Admin\Dashboard::login');
// $routes->post('/auth', 'Admin\Dashboard::checkLogin');
// $routes->get('/register', 'Admin\Dashboard::register');
// $routes->post('/reg', 'Admin\Dashboard::registerUser');

$routes->get('/forgot-pw', 'Auth::forgotPassword');
$routes->get('/logout', 'Admin\Dashboard::logout', ['as' => 'admin.logout'], ['filter' => 'auth']);
$routes->get('/dashboard', 'Admin\Dashboard::index', ['as' => 'admin.home'], ['filter' => 'auth']);

$routes->get('/scenes', 'Admin\Scenes::index', ['filter' => 'auth']);
$routes->get('/scenes/create', 'Admin\Scenes::create', ['filter' => 'auth']);
$routes->post('/scenes/store', 'Admin\Scenes::store', ['filter' => 'auth']);
$routes->get('/scenes/thumbnail', 'Admin\Scenes::thumbnail');
$routes->get('/scenes/render/(:any)', 'Admin\Scenes::render/$1');
$routes->delete('/scenes/(:num)', 'Admin\Scenes::delete/$1', ['filter' => 'auth']);
$routes->post('/scenes/update/(:num)', 'Admin\Scenes::update/$1', ['filter' => 'auth']);
$routes->get('/scenes/edit/(:segment)', 'Admin\Scenes::edit/$1', ['filter' => 'auth']);
$routes->get('/scenes/(:any)', 'Admin\Scenes::show/$1', ['filter' => 'auth']);

$routes->get('/hotspots', 'Admin\Hotspots::index', ['filter' => 'auth']);
$routes->get('/hotspots/create', 'Admin\Hotspots::create', ['filter' => 'auth']);
$routes->post('/hotspots/store', 'Admin\Hotspots::store', ['filter' => 'auth']);
$routes->delete('/hotspots/(:num)', 'Admin\Hotspots::delete/$1', ['filter' => 'auth']);
$routes->get('/hotspots/edit/(:segment)', 'Admin\Hotspots::edit/$1', ['filter' => 'auth']);
$routes->post('/hotspots/update/(:num)', 'Admin\Hotspots::update/$1', ['filter' => 'auth']);

$routes->get('/maps', 'Admin\Maps::index', ['filter' => 'auth']);
$routes->delete('/maps/(:num)', 'Admin\Maps::delete/$1', ['filter' => 'auth']);
$routes->get('/maps/edit/(:num)', 'Admin\Maps::edit/$1', ['filter' => 'auth']);
$routes->post('/maps/store', 'Admin\Maps::store', ['filter' => 'auth']);
$routes->post('/maps/update/(:num)', 'Admin\Maps::update/$1', ['filter' => 'auth']);

$routes->get('/account', 'Admin\Settings::account', ['filter' => 'auth']);
$routes->post('/account/updateAccount/(:num)', 'Auth::updateAccount/$1', ['as' => 'admin.account.handler'], ['filter' => 'auth']);
$routes->post('/account/updatePassword/(:num)', 'Auth::updatePassword/$1', ['as' => 'admin.password.handler'], ['filter' => 'auth']);
// $routes->post('/account/update/(:num)', 'Admin\Settings::updateAccount/$1', ['filter' => 'auth']);
// $routes->post('/account/updatePw/(:num)', 'Admin\Settings::updatePassword/$1', ['filter' => 'auth']);
$routes->get('/system', 'Admin\Settings::index', ['filter' => 'auth']);
$routes->post('/system/update/(:num)', 'Admin\Settings::update/$1', ['filter' => 'auth']);
