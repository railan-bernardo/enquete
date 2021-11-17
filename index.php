<?php
ob_start();
require __DIR__ . "/vendor/autoload.php";

use Source\Router\Router;
use Source\Core\Session;

$session = new Session();
$route = new Router(url(), ":");
$route->namespace("Source\App");



/**
 * WEB ROUTES
 */
$route->group(null);
$route->get("/", "Web:home");
$route->get("/cadastrar", "Web:register");
$route->post("/cadastrar", "Web:register");
$route->get("/update/{enqueteId}", "Web:register");
$route->post("/update/{enqueteId}", "Web:register");
$route->post("/cadastrar/{enquete_id}", "Web:register");
$route->post("/cadastrar/{enquete_id}", "Web:register");


/**
 * ERROR ROUTES
 */
$route->group("/ops");
$route->get("/{errcode}", "Web:error");

/**
 * ROUTE
 */
$route->dispatch();

/**
 * ERROR REDIRECT
 */
if ($route->error()) {
    $route->redirect("/ops/{$route->error()}");
}

ob_end_flush();
