<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use Illuminate\Contracts\Support\Renderable;
use function request;

class TweetsController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
        return view('tweets.index', [
            'tweets' => auth()->user()->timeline()
        ]);
    }

    public function store()
    {
        $attributes = request()->validate([
            'body' => 'required|max:255'
        ]);

        Tweet::create([
            'user_id' => auth()->id(),
            'body' => $attributes['body']
        ]);


        flashy()->info('Your Tweet successfully published');
        return redirect()->route('home');
    }

    public function destroy(Tweet $tweet)
    {
        Tweet::where('id', $tweet->id)->delete();

        flashy()->primaryDark('Tweet successfully deleted');
        return back();
    }
}
