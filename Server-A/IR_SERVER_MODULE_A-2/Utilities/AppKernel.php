<?php
/**
 * WorldSkills 2015
 *
 * Created by Mohamad Mohebifar.
 * Country: Iran
 */

namespace Utilities;


use Utilities\Exception\NotFoundException;

class AppKernel
{

    public function __construct()
    {

    }

    public function runAction($path, $params)
    {
        $path[0] = 'Application\\Controller\\' . $path[0];
        if (class_exists($path[0])) {
            $controller = new $path[0];

            if (method_exists($controller, $path[1])) {
                return call_user_func_array([$controller, $path[1]], $params);
            }
        }

        throw new NotFoundException('The requested route belongs to a non-existing controller/action node.');
    }

} 