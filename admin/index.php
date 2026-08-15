<?php
declare(strict_types=1);

require_once __DIR__ . '/../../core/Permission.php';

requirePermission('users.manage');

$routes = require __DIR__ . '/routes.php';

$route = $_GET['url'] ?? '';

$route = trim($route, '/');

if (array_key_exists($route, $routes)) {

    require __DIR__ . '/' . $routes[$route] . '.php';

    exit;
}

http_response_code(404);

echo '<h1>404 - Page Not Found</h1>';