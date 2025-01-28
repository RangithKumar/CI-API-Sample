<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->addRedirect('/', '/api/public/index');

$routes->group("api", function ($routes) {
    $routes->group("public", function ($routes) {
        $routes->group("docs", function ($routes) {
            $routes->get('/', 'SwagDocGen::index');
            $routes->get('generate', 'SwagDocGen::generate');
        });
        $routes->get("index", "API::index");
        $routes->post("sum", "API::sumArray");
        $routes->post("sumAlt", "API::sumAltArray");
    });
    $routes->get("/", "API::index");
    $routes->post("sum", "API::sumArray");
    $routes->post("sumAlt", "API::sumAltArray");
});
