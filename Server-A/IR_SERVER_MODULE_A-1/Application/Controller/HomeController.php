<?php
/**
 * WorldSkills 2015
 *
 * Created by Mohamad Mohebifar.
 * Country: Iran
 */

namespace Application\Controller;

use Utilities\Controller;

class HomeController extends Controller
{
    public function welcome()
    {
        $this->renderView('start');
    }
} 