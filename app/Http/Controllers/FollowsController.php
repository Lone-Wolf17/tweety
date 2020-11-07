<?php

namespace App\Http\Controllers;

use App\Models\User;

class FollowsController extends Controller
{
    public function store(User $user)
    {
        // have the auth'd user follow the given user
        auth()
            ->user()
            ->toggleFollow($user);

        if (current_user()->isFollowing($user)) {
            $message = "You just followed ";
        } else {
            $message = "You just unfollowed ";
        }

        flashy()->info($message . $user->name);

        return back();
    }

    public function edit(User $user)
    {
        return view('profiles.edit', compact('user'));
    }
}
