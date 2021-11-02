<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('cafe/customers', CustomerController::class);
    $router->resource('cafe/orders', Order2Controller::class);
    $router->resource('cafe/users', UserController::class);
    $router->resource('cafe/beans', BeanController::class);
    $router->post('cafe/shipped_mail', 'ToolsController@shipped_mail');

});
