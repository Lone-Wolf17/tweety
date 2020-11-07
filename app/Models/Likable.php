<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Builder;

trait Likable
{

    public function scopeWithLikes(Builder $query)
    {

        $query->leftJoinSub(
            'SELECT tweet_id, SUM(liked) likes, SUM(!liked) dislikes FROM `likes` GROUP BY tweet_id',
            'likes',
            'likes.tweet_id',
            'tweets.id'
        );
    }

    public function isDislikedBy(User $user)
    {
        return (bool)$user->likes
            ->where('tweet_id', $this->id)
            ->where('liked', false)
            ->count();
    }

    public function isLikedBy(User $user)
    {
        return (bool)$user->likes
            ->where('tweet_id', $this->id)
            ->where('liked', true)
            ->count();
    }

    public function dislike(User $user = null)
    {
        return $this->like($user, false);
    }

    public function like(User $user = null, $liked = true)
    {

        return $this->likes()->updateOrCreate([
            'user_id' => $user ? $user->id : auth()->id(),
        ],
            [
                'liked' => $liked,
            ]);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function delete(User $user = null)
    {
        return Like::where([
            ['user_id', $user ? $user->id : auth()->id()],
            ['tweet_id', $this->id]
        ])->delete();
    }
}
