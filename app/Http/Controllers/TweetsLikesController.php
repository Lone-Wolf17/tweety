<?php

namespace App\Http\Controllers;

use App\Models\Tweet;

class TweetsLikesController extends Controller
{
    public function store(Tweet $tweet)
    {

        // Destroy or delete record if already liked by user
        if ($tweet->isLikedBy(current_user())) {
            $tweet->delete(current_user());
        } else {
            $tweet->like(current_user());
        }

        return back();
    }

    public function destroy(Tweet $tweet)
    {
        // Destroy or delete record if already disliked by user
        if ($tweet->isDislikedBy(current_user())) {
            $tweet->delete(current_user());
        } else {
            $tweet->dislike(current_user());
        }

        return back();
    }
}
