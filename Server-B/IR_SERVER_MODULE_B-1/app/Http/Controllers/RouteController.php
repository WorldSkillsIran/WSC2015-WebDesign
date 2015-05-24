<?php namespace App\Http\Controllers;

use App\Book;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Route;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use App\Rate;
use Auth;
use Request;
use Input;

class RouteController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param string $type
     * @return Response
     */
    public function getIndex($type = 'available')
    {
        $mybooks = Book::all()->where('user_id', Auth::user()->id);

        switch ($type) {
            case 'bookmarked':
                $list = Route::all();
                break;
            case 'requested':
                $list = Route::all()->where('type', 'requested');
                break;
            case 'mine':
                $list = Route::all()
                    ->where('user_id', Auth::user()->id)
                    ->where('type', 'offered');
                break;
            case 'available':
                $list = Route::all()->where('type', 'offered');
                break;
        }

        $list->load('user');

        foreach ($mybooks as $book) {
            foreach ($list as $route) {
                if ($route->id === $book->route_id) {
                    $route->booked = true;
                    break;
                }
            }
        }

        if ($type === 'bookmarked') {
            $list = $list->filter(function ($route) {
                return $route->booked;
            });
        }

        return response()->view('routes', [
            'routes' => $list
        ]);
    }

    public function getCreate()
    {

        return response()->view('newroute');
    }

    public function postCreate()
    {
        $now = new \DateTime('+1 minutes');
        $now = $now->format('Y-m-d H:i:s');
        $all = Input::all();
        $all['_time'] = $all['date'] . ' ' . $all['time'];

        $v = Validator::make($all, [
            'from' => 'required',
            'to' => 'required',
            'type' => 'required|in:requested,offered',
            '_time' => 'after:' . $now,
            'date' => 'required|date',
            'time' => 'required',
        ]);

        if ($v->fails()) {
            return redirect()->back()->withErrors($v->errors())->withInput();
        } else {
            $all['time'] = $all['_time'];
            $all['user_id'] = Auth::user()->id;
            $route = Route::create($all);
            return response()->redirectTo('/')->with('message', "You have successfully bookmarked the route from {$route->from} to {$route->to}");
        }

    }

    public function postRate($route)
    {
        $v = Validator::make(Input::all(), [
            'rate' => 'required|min:1|max:5',
        ]);

        if ($v->fails()) {
            return redirect()->back()->withErrors($v->errors());
        } else {
            $route->load('user');

            Rate::create([
                'from' => Auth::user()->id,
                'to' => $route->user->id,
                'rate' => Input::get('rate')
            ]);

            $route->user->rate = Rate::where('to', $route->user->id)->avg('rate');
            $route->user->save();

            return redirect()->back()->with('message', "Your rate successfully submitted.");
        }

    }

    public function getBook($route)
    {
        $user = Auth::user();
        $book = new Book();
        $book->user_id = $user->id;
        $book->route_id = $route->id;
        $book->save();

        return response()->redirectTo('/')->with('message', "You have successfully bookmarked the route from {$route->from} to {$route->to}");
    }


}
