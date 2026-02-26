<?php

define('LARAVEL_START', microtime(true));

$appPath = '/home2/bulutist/repositories/bulutistihbarat';

if (file_exists($maintenance = $appPath.'/storage/framework/maintenance.php')) {
    require $maintenance;
}

require $appPath.'/vendor/autoload.php';

(require_once $appPath.'/bootstrap/app.php')
    ->handleRequest(\Illuminate\Http\Request::capture());
