<?php

require_once __DIR__.'/../vendor/autoload.php';

use CQ\Config\Config;
use CQ\Helpers\App;
use CQ\Routing\Router;

// Config
$config = new Config(__DIR__);
$config->attach('app');

// Debug Helper
if (App::debug()) {
    ini_set('error_reporting', E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);

    $whoops = new \Whoops\Run();
    $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler());
    $whoops->register();
}

// Router
$router = new Router([
    '404' => 'https://mail.castelnuovo.xyz',
    '500' => 'https://mail.castelnuovo.xyz',
]);

require __DIR__.'/../routes/web.php';

return $router;
