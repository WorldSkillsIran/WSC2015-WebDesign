<?php

namespace Application;


use Application\Exception\NotFoundException;

class AppKernel
{
    public static function getController($controller)
    {
        $controller = 'Application\\Controller\\' . $controller;

        if (class_exists($controller)) {
            return new $controller();
        } else {
            throw new NotFoundException('The Controller is not found.');
        }
    }

    public static function callAction($controller, $action, $params = [])
    {
        if (gettype($controller) === 'string') {
            $controller = static::getController($controller);
        }

        return call_user_func_array([$controller, $action], $params);
    }
} 