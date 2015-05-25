<?php
/**
 * WorldSkills 2015
 *
 * Created by Mohamad Mohebifar.
 * Country: Iran
 */

namespace Utilities;


class Request
{
    private static $singleton;

    /**
     * @var ParameterBag
     */
    public $request;

    /**
     * @var ParameterBag
     */
    public $query;

    /**
     * @var ParameterBag
     */
    public $session;

    public function __construct($post, $get, $session)
    {
        $this->request = new ParameterBag($post);
        $this->query = new ParameterBag($get);
        $this->session = new ParameterBag($session);
    }

    /**
     * Create a singleton with global variables
     *
     * @return Request
     */
    public static function createFromGlobals()
    {
        if (!isset(self::$singleton)) {
            session_start();

            self::$singleton = new static($_POST, $_GET, $_SESSION);
        }

        return self::$singleton;
    }
} 