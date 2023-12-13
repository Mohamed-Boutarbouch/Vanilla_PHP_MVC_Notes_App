<?php

namespace Core;

use Core\Middleware\Middleware;

class Router
{
  protected $routes = [];

  private const GET = 'GET';
  private const POST = 'POST';
  private const PUT = 'PUT';
  private const PATCH = 'PATCH';
  private const DELETE = 'DELETE';

  public function add($uri, $controller, $method)
  {
    $this->routes[] = [
      'uri' => $uri,
      'controller' => $controller,
      'method' => $method,
      'middleware' => null
    ];

    return $this;
  }

  public function get($uri, $controller)
  {
    return $this->add($uri, $controller, self::GET);
  }

  public function post($uri, $controller)
  {
    return $this->add($uri, $controller, self::POST);
  }

  public function put($uri, $controller)
  {
    return $this->add($uri, $controller, self::PUT);
  }

  public function patch($uri, $controller)
  {
    return $this->add($uri, $controller, self::PATCH);
  }

  public function delete($uri, $controller)
  {
    return $this->add($uri, $controller, self::DELETE);
  }

  public function route($uri, $method)
  {
    foreach ($this->routes as $route) {
      if ($route['uri'] === $uri && $route['method'] === strtoupper($method)) {
        Middleware::resolve($route['middleware']);

        return require basePath($route['controller']);
      }
    }
    $this->abort();
  }

  public function only($key)
  {
    $this->routes[array_key_last($this->routes)]['middleware'] = $key;

    dd($this->routes);
    return $this;
  }


  protected function abort($code = 404)
  {
    http_response_code($code);

    require basePath("views/{$code}.php");

    die();
  }
}
