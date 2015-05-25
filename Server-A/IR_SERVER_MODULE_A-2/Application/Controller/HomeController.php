<?php
/**
 * WorldSkills 2015
 *
 * Created by Mohamad Mohebifar.
 * Country: Iran
 */

namespace Application\Controller;

use Application\Model\Game;
use Utilities\Controller;
use Utilities\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $this->renderView('index');
    }


    public function play(Request $request)
    {
        $game = Game::load();

        if ($game === null) {
            return $this->redirect('/');
        }
        $result = new \stdClass();
        $result->message= '';

        if($request->query->has('fromStackId', 'toStackId', 'brickId')) {
            $fId = $request->query->get('fromStackId');
            $tId = $request->query->get('toStackId');
            $bId = $request->query->get('brickId');

            if(array_key_exists($fId, $game->stacks) && array_key_exists($tId, $game->stacks) && array_key_exists($bId, $game->stacks)) {
                $stack1 = $game->stacks[$request->query->get('fromStackId')];
                $stack2 = $game->stacks[$request->query->get('toStackId')];
                $brick = $game->bricks[$request->query->get('brickId')];
                $result = $game->move($brick, $stack1, $stack2);
            } else {
                $result = new \stdClass();
                $result->message= 'Invalid Data :(';
            }
        }

        $this->renderView('game', [
            'game' => $game,
            'result' => $result
        ]);
    }


    public function start(Request $request)
    {
        $game = new Game();
        $game->setPlayerName($request->request->get('name'));
        $game->setBricks($request->request->get('bricks'));
        $game->save();

        $this->redirect('/play');
    }
} 