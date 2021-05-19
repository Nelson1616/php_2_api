<?php

namespace App;

class Route 
{
    private $routes = [];

    public function getRoutes()
    {
        return $this->routes;
    }

    public function run($prefix)
    {
        foreach($this->routes as $route)
        {
            $route['method'] = strtoupper($route['method']);
            $route['url'] = '/' . $prefix . $route['url'];

            $pure_route = '';
            $param = '';
            if(str_contains($route['url'], '{}'))
            {
                $pure_route = str_replace("{}", "", $route['url']);
                $param = str_replace($pure_route, "", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
                $route['url'] = $pure_route . $param;
            }
            
        
            if(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) == $route['url'] && $route['method'] == parse_url($_SERVER['REQUEST_METHOD'], PHP_URL_PATH))
            {
                $class = "\\App\\Http\\Controllers\\" . $route['controller'];
                $controller = new $class;
                $action = $route['action'];
                if($param != '')
                {
                    return $controller->$action($param);
                }
                else
                {
                    return $controller->$action();
                }          
            }
        }

        return 'Não encontrado';
    }

    public function newRoute($url, $controller, $action, $method)
    {
        array_push($this->routes, ['url' => $url, 'controller' => $controller, 'action' => $action, 'method' => $method]);
    }
}
?>