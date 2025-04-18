<?php
class Router {
    private $routes = [];

    public function add($route, $controller, $action) {
        $this->routes[$route] = ['controller' => $controller, 'action' => $action];
    }

    public function dispatch($uri) {
        foreach ($this->routes as $route => $target) {
            if (preg_match("#^$route$#", $uri, $params)) {
                $controllerName = 'Controllers\\' . $target['controller'];
                $action = $target['action'];
    
                if (!class_exists($controllerName)) {
                    throw new Exception("Controller $controllerName not found.");
                }
    
                $controller = new $controllerName();
    
                return $controller->$action(...array_slice($params, 1));
            }
        }
    
        header("HTTP/1.0 404 Not Found");
        include 'views/404.php';
    }    
    
}
