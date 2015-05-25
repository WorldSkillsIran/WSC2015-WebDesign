<?php
/**
 * WorldSkills 2015
 *
 * Created by Mohamad Mohebifar.
 * Country: Iran
 */

namespace Utilities;


class Controller
{
    protected function renderView($view, $params = [])
    {
        extract($params);
        include "./Resources/{$view}.phtml";
    }

    protected function redirect($to)
    {
        header('Location: ' . trim(BASE_URL, '/') . $to);
    }
}