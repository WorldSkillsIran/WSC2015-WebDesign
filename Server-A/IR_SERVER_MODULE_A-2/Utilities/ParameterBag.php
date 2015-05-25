<?php
/**
 * WorldSkills 2015
 *
 * Created by Mohamad Mohebifar.
 * Country: Iran
 */

namespace Utilities;


class ParameterBag
{
    private $parameters;

    public function __construct(&$array)
    {
        $this->parameters =& $array;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function get($id)
    {
        return $this->parameters[$id];
    }

    /**
     * @param $id
     * @param $value
     * @internal param mixed $parameters
     */
    public function set($id, $value)
    {
        $this->parameters[$id] = $value;
    }

    /**
     * @return bool
     */
    public function has()
    {
        foreach (func_get_args() as $arg) {
            if (!array_key_exists($arg, $this->parameters)) {
                return false;
            }
        }

        return true;
    }


} 