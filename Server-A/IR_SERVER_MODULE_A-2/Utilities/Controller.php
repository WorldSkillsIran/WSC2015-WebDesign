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

    /**
     * Render a view
     *
     * @param $view
     * @param array $params
     * @return bool
     */
    protected function renderView($view, $params = [])
    {
        extract($params);

        include './Application/Resources/' . $view . '.phtml';
        return true;
    }

    /**
     * Redirect to given URL
     *
     * @param $to
     * @return bool
     */
    protected function redirect($to)
    {
        header('Location: ' . BASE_URL . $to);
        return true;
    }

} 