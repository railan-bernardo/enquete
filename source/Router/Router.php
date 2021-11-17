<?php

namespace Source\Router;

/**
* class Source Router
* @author Railan Bernardo <https://github/railan-bernardo>
* @package Source\Router
*/
class Router extends Dispatch
{

public  function __construct(string $projectUrl, ?string $separator = ":")
  {
    parent::__construct($projectUrl, $separator);
  }

  /**
 * @param string $route
 * @param $handler
 * @param string|null $name
 */
public function post(string $route, $handler, string $name = null): void
{
    $this->addRoute("POST", $route, $handler, $name);
}

/**
 * @param string $route
 * @param $handler
 * @param string|null $name
 */
public function get(string $route, $handler, string $name = null): void
{
    $this->addRoute("GET", $route, $handler, $name);
}

/**
 * @param string $route
 * @param $handler
 * @param string|null $name
 */
public function put(string $route, $handler, string $name = null): void
{
    $this->addRoute("PUT", $route, $handler, $name);
}

/**
 * @param string $route
 * @param $handler
 * @param string|null $name
 */
public function patch(string $route, $handler, string $name = null): void
{
    $this->addRoute("PATCH", $route, $handler, $name);
}

/**
 * @param string $route
 * @param $handler
 * @param string|null $name
 */
public function delete(string $route, $handler, string $name = null): void
{
    $this->addRoute("DELETE", $route, $handler, $name);
}
}