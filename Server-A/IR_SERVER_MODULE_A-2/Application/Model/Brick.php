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
    private $game;

    public $id;

    /**
     * Stack Constructor
     * @param Game $game
     */
    public function __construct(Game $game)
    {
        $this->game = $game;

        $this->id = count($this->game->bricks);
    }

    /**
     * @return Stack
     */
    public function getStack()
    {
        foreach ($this->game->stacks as $stack) {
            if ($stack->hasBrick($this)) {
                return $stack;
            }
        }

        return false;
    }

    public function isOnTop()
    {
        return $this->getStack()->getBrickPosition($this) === 0;
    }
} 