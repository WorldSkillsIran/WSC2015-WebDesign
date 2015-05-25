<?php
/**
 * WorldSkills 2015
 *
 * Created by Mohamad Mohebifar.
 * Country: Iran
 */

namespace Application\Model;


class Stack implements \ArrayAccess, \Iterator
{
    private $bricks = [];
    private $position = 0;
    private $id = 0;

    public function __construct(Game $game)
    {
        $this->id = count($game->stacks);
    }

    public function count()
    {
        return count($this->bricks);
    }

    /**
     * Get the position of given brick
     *
     * @param Brick $brick
     * @return bool|int|string
     */
    public function getBrickPosition(Brick $brick)
    {
        return array_search($brick, $this->bricks);
    }

    public function isOnTop(Brick $brick)
    {
        $pos = $this->getBrickPosition($brick);
        if ($pos === false) {
            return false;
        }

        return $pos + 1 === count($this->bricks);
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Return the current element
     * @return mixed Can return any type.
     */
    public function current()
    {
        return $this->bricks[$this->position];
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Move forward to next element
     * @return void Any returned value is ignored.
     */
    public function next()
    {
        ++$this->position;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Return the key of the current element
     * @return mixed scalar on success, or null on failure.
     */
    public function key()
    {
        return key($this->bricks[$this->position]);
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Checks if current position is valid
     * @return boolean The return value will be casted to boolean and then evaluated.
     * Returns true on success or false on failure.
     */
    public function valid()
    {
        return isset($this->bricks[$this->position]);
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Rewind the Iterator to the first element
     * @return void Any returned value is ignored.
     */
    public function rewind()
    {
        $this->position = 0;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Whether a offset exists
     * @param mixed $offset <p>
     * An offset to check for.
     * </p>
     * @return boolean true on success or false on failure.
     * </p>
     * <p>
     * The return value will be casted to boolean if non-boolean was returned.
     */
    public function offsetExists($offset)
    {
        return isset($this->bricks[$offset]);
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Offset to retrieve
     * @param mixed $offset <p>
     * The offset to retrieve.
     * </p>
     * @return mixed Can return all value types.
     */
    public function offsetGet($offset)
    {
        return $this->bricks[$offset];
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Offset to set
     * @param mixed $offset <p>
     * The offset to assign the value to.
     * </p>
     * @param mixed $value <p>
     * The value to set.
     * </p>
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        if ($offset === null) {
            array_push($this->bricks, $value);
        } else {
            $this->bricks[$offset] = $value;
        }
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Offset to unset
     * @param mixed $offset <p>
     * The offset to unset.
     * </p>
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->bricks[$offset]);
        $this->bricks = array_values($this->bricks);
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    public function getTop()
    {
        return isset($this->bricks[$this->count() - 1]) ? $this->bricks[$this->count() - 1] : null;
    }
}