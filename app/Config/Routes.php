<?php

use App\Controllers\Dashboard;
use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');

$routes->get('/main', 'Dashboard::main');
$routes->get('/qrcodescan', 'Dashboard::qrcodescan');

$routes->get('/attendant', 'Dashboard::attendant');
$routes->get('/assign-parking', 'Dashboard::assignParking');


$routes->get('/login', 'Home::login');
$routes->get('/account-registration', 'Home::register');

$routes->get('/profile', 'Dashboard::userProfile');

$routes->get('/update-profile', 'Dashboard::updateProfile');

$routes->post('/authenticate', 'LoginController::authenticate');
