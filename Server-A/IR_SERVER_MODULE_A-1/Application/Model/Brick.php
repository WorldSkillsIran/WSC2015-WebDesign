<?php
/**
 * WorldSkills 2015
 *
 * Created by Mohamad Mohebifar.
 * Country: Iran
 */

namespace Application\Model;


class Brick
{
    public $id = 1;

    private $game;

    /**
     * @param Game $game
     */
    public function __construct(Game $game)
    {
        $this->game = $game;
    }

    /**
     * Get the stack that this brick belongs to
     *
     * @return Stack|null
     */
    public function getStack()
    {

        foreach ($this->game->stacks as $stack) {
            if ($stack->getBrickPosition($this) !== false) {
                return $stack;
            }
        }

        return null;

    }

    public function moveTo(Stack $stack)
    {
        $top = $stack->getTop();

        if ($top instanceof Brick && $top->id < $this->id) {
            return false;
        } else {
            unset($this->getStack()[$this->getStack()->getBrickPosition($this)]);
            $stack[] = $this;
            $this->game->move();
            return true;
        }
    }
} 