<?php
declare(strict_types=1);

/*
|--------------------------------------------------------------------------
| Load App Configuration
|--------------------------------------------------------------------------
*/

$config = require __DIR__ . '/config/app.php';

/*
|--------------------------------------------------------------------------
| Timezone
|--------------------------------------------------------------------------
*/

date_default_timezone_set($config['timezone']);

/*
|--------------------------------------------------------------------------
| Error Reporting
|--------------------------------------------------------------------------
*/

if ($config['debug']) {

    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);

} else {

    ini_set('display_errors', '0');
    ini_set('display_startup_errors', '0');
    error_reporting(0);

}

/*
|--------------------------------------------------------------------------
| Load Router
|--------------------------------------------------------------------------
*/

try {

    require_once __DIR__ . '/core/Router.php';

    $router = new Router();

    $router->dispatch();

} catch (Throwable $exception) {

    http_response_code(500);

    if ($config['debug']) {

        throw $exception;

    }

    require_once __DIR__ . '/pages/500.php';

}