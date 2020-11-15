<?php

use CQ\Routing\Middleware;
use CQ\Routing\Route;

Route::$router = $router->get();
Middleware::$router = $router->get();

Route::any('/mail/config-v1.1.xml', 'AutoMXController@index');
Route::any('/autodiscover/autodiscover.xml', 'AutoMXController@index');
Route::any('/Autodiscover/Autodiscover.xml', 'AutoMXController@index');
