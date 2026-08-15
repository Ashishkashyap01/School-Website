<?php
declare(strict_types=1);

class Router
{
    private array $routes;

    public function __construct()
    {
        $this->routes = require __DIR__ . '/../config/routes.php';
    }

    public function dispatch(): void
    {
        $basePath = '/srs';

        $request = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        $route = trim(str_replace($basePath, '', $request), '/');

        if (array_key_exists($route, $this->routes)) {

            require __DIR__ . '/../pages/' . $this->routes[$route] . '.php';

            return;
        }

        http_response_code(404);

        require __DIR__ . '/../pages/404.php';
    }
}