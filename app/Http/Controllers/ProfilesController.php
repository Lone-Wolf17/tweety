<?php

namespace App\Http\Controllers;


use App\Models\User;

class ProfilesController extends Controller
{
    public function show(User $user)
    {
        return view('profiles.show', compact('user'));
    }
}
