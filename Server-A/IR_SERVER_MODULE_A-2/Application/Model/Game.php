<?php
/**
 * WorldSkills 2015
 *
 * Created by Mohamad Mohebifar.
 * Country: Iran
 */

namespace Application\Model;


use Utilities\Request;

class Game
{
    public $stacks = [];

    public $bricks = [];

    private $playerName;

    private $moves = 0;

    public function __construct()
    {
        $this->stacks[] = new Stack($this);
        $this->stacks[] = new Stack($this);
        $this->stacks[] = new Stack($this);
    }

    public function setBricks($number)
    {
        for ($i = 0; $i < $number; $i++) {
            $this->bricks[] = new Brick($this);
            $this->stacks[0][] = $this->bricks[$i];
        }
    }

    public function win()
    {
        if (count($this->stacks[2]) !== count($this->bricks)) {
            return false;
        }

        $lastBrick = -1;

        foreach ($this->stacks[2] as $brick) {
            if ($lastBrick > $brick->id) {
                return false;
            }

            $lastBrick = $brick->id;
        }

        return true;
    }

    /**
     * @return mixed
     */
    public function getPlayerName()
    {
        return $this->playerName;
    }

    /**
     * @param mixed $playerName
     */
    public function setPlayerName($playerName)
    {
        $this->playerName = $playerName;
    }

    /**
     * @return mixed
     */
    public function getMoves()
    {
        return $this->moves;
    }

    /**
     * @param Brick $brick
     * @param Stack $from
     * @param Stack $to
     * @return \stdClass
     */
    public function move(Brick $brick, Stack $from, Stack $to)
    {
        $result = new \stdClass();
        $result->message = '';

        if ($from->hasBrick($brick)) {
            if ($brick->isOnTop()) {
                if ($to->canTake($brick)) {
                    unset($from[$from->getBrickPosition($brick)]);
                    $to->unshift($brick);

                    $this->moves++;
                } else {
                    $result->message = 'The stack should be smaller than the bottom one.';
                }
            } else {
                $result->message = 'The brick is not on top.';
            }
        } else {
            $result->message = 'The given brick does not exist in the given stack.';
        }

        return $result;
    }

    public function save()
    {
        $_SESSION['game'] = $this;
    }

    /**
     * @return Game|bool
     */
    public static function load()
    {
        if (Request::createFromGlobals()->session->has('game')) {
            return Request::createFromGlobals()->session->get('game');
        } else {
            return null;
        }
    }
} 