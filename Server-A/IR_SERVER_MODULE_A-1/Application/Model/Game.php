<?php
/**
 * WorldSkills 2015
 *
 * Created by Mohamad Mohebifar.
 * Country: Iran
 */

namespace Application\Model;


class Game
{
    /**
     * @var Stack[]
     */
    public $stacks = [

    ];

    public $bricks = [];

    private $playerName;

    private $moves = 0;

    public function __construct()
    {
        $this->stacks[] = new Stack($this);
        $this->stacks[] = new Stack($this);
        $this->stacks[] = new Stack($this);
    }

    /**
     * @param $i
     * @return Stack
     */
    public function getStack($i)
    {
        return $this->stacks[$i];
    }

    /**
     * @param $i
     * @return Brick|bool
     */
    public function getBrick($i)
    {
        foreach ($this->bricks as $brick) {
            if ($brick->id == $i) {
                return $brick;
            }
        }

        return false;
    }

    /**
     * Check if the stack id exists
     *
     * @param $id
     * @return bool
     */
    public function isValidStack($id)
    {
        return $id >= 0 && $id <= 2;
    }

    /**
     * Returns the game with the session
     *
     * @return Game|null
     */
    public static function load()
    {
        if (isset($_SESSION['game']) && $_SESSION['game'] instanceof Game) {
            return $_SESSION['game'];
        } else {
            return null;
        }
    }

    /**
     * @param $number
     */
    public function createBricks($number)
    {
        for ($i = $number - 1; $i >= 0; $i--) {
            $brick = new Brick($this);
            $brick->id = $i;
            $this->stacks[0][] = $brick;
            $this->bricks[] = $brick;
        }
    }

    public function bricksCount()
    {
        return count($this->bricks);
    }

    public function save()
    {
        $_SESSION['game'] = $this;
    }

    public function win()
    {
        $lastValue = 5;

        if ($this->bricksCount() !== $this->stacks[2]->count()) {
            return false;
        }

        foreach ($this->stacks[2] as $brick) {
            if ($lastValue < $brick->id) {
                return false;
            }

            $lastValue = $brick->id;
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
     * @return int
     */
    public function getMoves()
    {
        return $this->moves;
    }

    /**
     * Called when a brick moves
     */
    public function move()
    {
        $this->moves++;
    }
}