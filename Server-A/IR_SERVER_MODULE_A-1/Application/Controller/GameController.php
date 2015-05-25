<?php
/**
 * WorldSkills 2015
 *
 * Created by Mohamad Mohebifar.
 * Country: Iran
 */

namespace Application\Controller;

use Application\Model\Brick;
use Application\Model\Game;
use Utilities\Controller;
use Utilities\Request;

class GameController extends Controller
{
    public function game(Request $request)
    {
        $game = Game::load();
        if ($game === null) {
            return $this->redirect('/');
        }

        $error = null;
        if ($request->hasGet('fromStackId', 'toStackId', 'brickId')) {
            $fromStackId = $request->get('fromStackId');
            $toStackId = $request->get('toStackId');
            $brickId = $request->get('brickId');

            if ($game->isValidStack($fromStackId) && $game->isValidStack($toStackId)) {


                $stack1 = $game->getStack($fromStackId);
                $stack2 = $game->getStack($toStackId);
                $brick = $game->getBrick($brickId);

                if ($brick instanceof Brick) {

                    if ($stack1->isOnTop($brick)) {
                        if (!$brick->moveTo($stack2)) {
                            $error = 'The brick should be smaller than the top one';
                        }
                    } else {
                        $error = 'You can just move the top brick';
                    }

                } else {
                    $error = 'The given brick does not exist';
                }


            } else {

                $error = 'The given stack does not exist';
            }
        }

        $this->renderView('game', [
            'game' => $game,
            'error' => $error
        ]);
    }

    public function start(Request $request)
    {
        $game = new Game();
        $game->createBricks($request->post('bricks'));
        $game->setPlayerName($request->post('name'));
        $game->save();

        $this->redirect('/game');
    }
} 