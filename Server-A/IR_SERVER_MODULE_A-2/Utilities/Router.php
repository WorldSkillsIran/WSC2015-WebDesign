<?php
/**
 * WorldSkills 2015
 *
 * Created by Mohamad Mohebifar.
 * Country: Iran
 */

namespace Utilities;


class Router
{
    private $routes = [];
    private $kernel;

    public function __construct(AppKernel $kernel)
    {
        $this->kernel = $kernel;
    }

    public function import()
    {
        $routes = include './Application/routes.php';

        foreach ($routes as $route => $path) {
            $this->set($route, $path);
        }
    }

    public function set($route, $path)
    {
        $this->routes['#^' . $route . '$#'] = explode('@', $path);
    }

    public function route($uri)
    {
        foreach ($this->routes as $route => $path) {
            if (preg_match($route, $uri, $params)) {
                $params[0] = Request::createFromGlobals();
                $this->kernel->runAction($path, $params);
            }
        }

    }
} 