<?php
/**
 * WorldSkills 2015
 *
 * Created by Mohamad Mohebifar.
 * Country: Iran
 */

namespace Application\Model;


class Stack implements \ArrayAccess, \Iterator, \Countable
{

    private $position = 0;

    private $array = [];

    private $game;

    public $id;

    /**
     * Stack Constructor
     * @param Game $game
     */
    public function __construct(Game $game)
    {
        $this->game = $game;

        $this->id = count($this->game->stacks);
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Return the current element
     * @return mixed Can return any type.
     */
    public function current()
    {
        return $this->array[$this->position];
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Move forward to next element
     * @return void Any returned value is ignored.
     */
    public function next()
    {
        $this->position++;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Return the key of the current element
     * @return mixed scalar on success, or null on failure.
     */
    public function key()
    {
        return $this->position;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Checks if current position is valid
     * @return boolean The return value will be casted to boolean and then evaluated.
     * Returns true on success or false on failure.
     */
    public function valid()
    {
        return array_key_exists($this->position, $this->array);
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
        return array_key_exists($offset, $this->array);
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
        return $this->array[$offset];
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
            $this->array[] = $value;
        } else {
            $this->array[$offset] = $value;
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
        unset($this->array[$offset]);

        $this->array = array_values($this->array);
    }

    /**
     * (PHP 5 &gt;= 5.1.0)<br/>
     * Count elements of an object
     * @return int The custom count as an integer.
     * </p>
     * <p>
     * The return value is cast to an integer.
     */
    public function count()
    {
        return count($this->array);
    }

    public function getBrickPosition(Brick $brick)
    {
        return array_search($brick, $this->array);
    }

    public function hasBrick(Brick $brick)
    {
        return $this->getBrickPosition($brick) !== false;
    }

    public function canTake(Brick $brick)
    {
        if($this->count() === 0) {
            return true;
        }

        $lastBrick = $this->array[0];
        return $lastBrick->id > $brick->id;
    }

    public function unshift($value)
    {
        array_unshift($this->array, $value);
    }
}