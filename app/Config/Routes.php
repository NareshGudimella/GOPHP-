<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->add('/about','Home::about');
$routes->add('/leftsidebar','Home::leftside');
$routes->set404Override(function()
{
    echo view("errors/custom-errors");
}
);

$routes->get('/contact','Contactcontroller::index');
$routes->post('/contact','Contactcontroller::index');

$routes->add('/register','Registercontroller::index');
$routes->add('/register/activate/(:any)','Registercontroller::activate/$1');
$routes->add('/register/activate','Registercontroller::activate');
$routes->get('/login','Logincontroller::index');
$routes->post('/login','Logincontroller::index');


 $routes->group('',['filter'=>'islogin'], function($routes){
    $routes->add('/dashboard','Dashboard::index');
    $routes->add('/dashboard/logout','Dashboard::Logout');
    $routes->add('/dashboard/activity','Dashboard::Login_activity');
   
    $routes->add('/dashboard/upload','Dashboard::upload_avatar');
    $routes->add('/dashboard/change_password','Dashboard::change_pwd');
    $routes->add('/dashboard/edit','Dashboard::edit');
 });
 $routes->add('login/forgot_password','Logincontroller::forgot_password');
$routes->add('/login/reset_password/(:any)','Logincontroller::reset_passsword/$1');
$routes->add('/uploads/(:any)','FileController::index');
 $routes->add('/update_pic','Fileuploadcontroller::index');