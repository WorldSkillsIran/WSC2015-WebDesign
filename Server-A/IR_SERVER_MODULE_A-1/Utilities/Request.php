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

    private $session;
    private $post;
    private $get;
    private static $singleton;

    /**
     * @param $post
     * @param $get
     * @param $session
     */
    public function __construct($post, $get, $session)
    {
        $this->get =& $get;
        $this->post =& $post;
        $this->session =& $session;
    }

    public static function createFromGlobals()
    {
        if (!isset(self::$singleton)) {
            session_start();
            self::$singleton = new static($_POST, $_GET, $_SESSION);
        }

        return self::$singleton;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function session($id)
    {
        return $this->session[$id];
    }

    /**
     * @param $id
     * @param mixed $session
     */
    public function setSession($id, $session)
    {
        $this->session[$id] = $session;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function post($id)
    {
        return $this->post[$id];
    }

    /**
     * @param $id
     * @param mixed $post
     */
    public function setPost($id, $post)
    {
        $this->post[$id] = $post;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function get($id)
    {
        return $this->get[$id];
    }

    /**
     * @return mixed
     */
    public function hasGet()
    {
        foreach (func_get_args() as $arg) {
            if (!array_key_exists($arg, $this->get)) {
                return false;
            }
        }

        return true;
    }

    /**
     * @param $id
     * @param mixed $get
     */
    public function setGet($id, $get)
    {
        $this->get[$id] = $get;
    }
} 