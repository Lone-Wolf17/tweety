<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Validation\Rule;

class ProfilesController extends Controller
{
    public function show(User $user)
    {
        return view('profiles.show', [
            'user' => $user,
            'tweets' => $user->tweets()
                ->withLikes()
                ->paginate(50)
        ]);
    }

    public function edit(User $user)
    {

        return view('profiles.edit', compact('user'));
    }

    public function update(User $user)
    {

        $attributes = request()->validate([
            'username' => ['string', 'required', 'max:255', 'alpha_dash', Rule::unique('users')->ignore($user)],
            'name' => ['string', 'required', 'max:255'],
            'description' => ['string', 'required', 'max:160',],
            'avatar' => ['file', 'image|mimes:jpeg,png,jpg'],
            'banner_image' => ['file', 'image|mimes:jpeg,png,jpg'],
            'email' => ['string', 'required', 'email', 'max:255', Rule::unique('users')->ignore($user)],
            'password' => ['string', 'nullable', 'min:8', 'max:255', 'confirmed']
        ]);

        if (request('avatar')) {
            $attributes['avatar'] = request('avatar')->store('avatars');
        }

        if (request('banner_image')) {
            $attributes['banner_image'] = request('banner_image')->store('banners');
        }

        if (!request('password')) {
            $attributes['password'] = $user->getAuthPassword();
        }

        $user->update($attributes);

        return redirect($user->path());
    }
}
