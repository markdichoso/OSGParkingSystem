<?php

use App\Controllers\Dashboard;
use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
// $routes->get('/', 'Home::index');

$routes->get('/', 'Home::login');

$routes->get('/account-registration', 'Home::register');
$routes->post('/register-submit', 'Home::registerSubmit');

$routes->get('/reg-status-submitted', 'Home::registerSubmit');




$routes->get('/main', 'Dashboard::main');

$routes->get('/qrcodescan', 'Dashboard::qrcodescan');

$routes->get('/attendant', 'Dashboard::attendant');

$routes->post('/assign-parking', 'Dashboard::assignParking');

$routes->post('/confirm-entry', 'Dashboard::confirmEntry');

$routes->get('/profile', 'Dashboard::userProfile');

$routes->get('/update-profile', 'Dashboard::updateProfile');
$routes->post('/profile/save', 'Dashboard::saveProfile');
$routes->post('/profile/vehicles/save', 'Dashboard::saveVehicle');
$routes->post('/profile/vehicles/delete', 'Dashboard::deleteVehicle');

$routes->post('/authenticate', 'Home::authenticate');

$routes->get('/signout', 'Home::signout');

$routes->get('/parking-entry-confirmed', 'Dashboard::parkingEntryConfirmation');

$routes->get('/reg-approval', 'Home::regApproval');

$routes->get('/password-reset', 'Home::passwordReset');
$routes->post('/password-reset-submit', 'Home::passwordResetSubmit');
