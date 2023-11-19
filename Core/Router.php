<?php

namespace Core;

class Router
{
  protected $routes = [];

  const METHOD_GET = 'GET';
  const METHOD_POST = 'POST';
  const METHOD_PUT = 'PUT';
  const METHOD_PATCH = 'PATCH';
  const METHOD_DELETE = 'DELETE';

  public function add($uri, $controller, $method)
  {
    $this->routes[] = [
      'uri' => $uri,
      'controller' => $controller,
      'method' => $method
    ];
  }

  public function get($uri, $controller)
  {
    $this->add($uri, $controller, self::METHOD_GET);
  }

  public function post($uri, $controller)
  {
    $this->add($uri, $controller, self::METHOD_POST);
  }

  public function put($uri, $controller)
  {
    $this->add($uri, $controller, self::METHOD_PUT);
  }

  public function patch($uri, $controller)
  {
    $this->add($uri, $controller, self::METHOD_PATCH);
  }

  public function delete($uri, $controller)
  {
    $this->add($uri, $controller, self::METHOD_DELETE);
  }

  public function route($uri, $method)
  {
    foreach ($this->routes as $route) {
      if ($route['uri'] === $uri && $route['method'] === strtoupper($method)) {
        return require basePath($route['controller']);
      }
    }
    $this->abort();
  }

  protected function abort($code = 404)
  {
    http_response_code($code);

    require basePath("views/{$code}.php");

    die();
  }
}
