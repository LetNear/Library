<?php

use App\Controllers\User;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'User::index');
$routes->get('/user/delete/(:num)', 'User::deleteUser/$1');
$routes->get('/user/edit/(:num)', 'User::editUser/$1');
$routes->post('/user/edit/(:num)', 'User::editUser/$1');
$routes->get('/user/create', 'User::createUser');
$routes->post('/user/create', 'User::createUser');
$routes->get('/login/googleAuth', 'GoogleAuth::index');

//login and register
$routes->get('/login','Login::index');
$routes->post('/login/authenticate','Login::authenticate');
$routes->get('logout','Login::logout');

$routes->get('/register','Registration::index');
$routes->post('/register/create','Registration::create');

// APIS 
$routes->get('/api/users', 'Api::users');
$routes->get('api/user/email', 'Api::getUserByEmail');
$routes->get('/api/users/(:num)', 'Api::getUser/$1');
$routes->delete('/api/users/(:num)', 'Api::deleteUser/$1');
$routes->post('/api/users/create', 'Api::createUser');
$routes->put('/api/users/(:num)', 'Api::updateUser/$1');

$routes->get('/api/books', 'Api::getBook');
$routes->post('/api/books/create', 'Api::createBook');
$routes->delete('/api/books/(:num)', 'Api::deleteBook/$1');
$routes->put('/api/books/(:num)', 'Api::updateBook/$1');

$routes->get('/api/cart/(:num)', 'Api::cart/$1');
$routes->post('/api/cart/create', 'Api::createCart');
$routes->delete('/api/cart/(:num)', 'Api::deleteCart/$1'); 
$routes->put('/api/cart/(:num)', 'Api::updateCart/$1');


$routes->get('/book/index', 'Book::index');
$routes->get('/book/delete/(:num)', 'Book::deleteBook/$1');
$routes->get('/book/edit/(:num)', 'Book::editBook/$1');
$routes->post('/book/edit/(:num)', 'Book::editBook/$1');
$routes->get('/book/create', 'Book::createBook');
$routes->post('/book/create', 'Book::createBook');

$routes->get('/cart/index', 'Cart::index');
$routes->post('/cart/delete/(:num)', 'Cart::removeFromCart/$1');
$routes->get('/cart/edit/(:num)', 'Cart::editItem/$1');
$routes->post('/cart/edit/(:num)', 'Cart::editItem/$1');
$routes->get('/cart/addToCart', 'Cart::addToCart');
$routes->post('/cart/addToCart', 'Cart::addCart');


$routes->get('/home', 'Home::index');
$routes->post('/cartadded', 'CartAdd::add');
$routes->get('/cartAdded/index', 'CartAdd::index');







