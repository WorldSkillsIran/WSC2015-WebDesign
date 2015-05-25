<?php

namespace Utilities;

use Application\AppKernel;
use Application\Exception\NotFoundException;

class Router
{
    private $routes = [];

    /**
     * Import routes from routes.php
     */
    public function import()
    {
        $routes = include './Application/routes.php';

        foreach ($routes as $route => $path) {
            $this->routes['#^' . $route . '$#'] = explode('@', $path);
        }
    }

    /**
     * Route with given uri
     *
     * @param $uri
     * @return mixed
     * @throws NotFoundException
     */
    public function route($uri)
    {
        foreach ($this->routes as $route => $to) {
            if (preg_match($route, $uri, $params)) {
                $params[0] = Request::createFromGlobals();
                return AppKernel::callAction($to[0], $to[1], $params);
            }
        }

        throw new NotFoundException('No route found :(');

    }

} 