<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->addRedirect('/', '/api');

$routes->group("api", function ($routes) {
    $routes->group("public", function ($routes) {
        $routes->get("/", "API::index");
        $routes->post("sum", "API::sumArray");
        $routes->post("sumAlt", "API::sumAltArray");
    });
    $routes->get("/", "API::index");
    $routes->post("sum", "API::sumArray");
    $routes->post("sumAlt", "API::sumAltArray");
});
