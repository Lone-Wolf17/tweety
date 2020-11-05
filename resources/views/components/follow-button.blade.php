
@unless (current_user()->is($user))
    <form method="POST"
          action="{{ route('follow', $user->username) }}">

        @csrf

        <x-button>
            {{ current_user()->isFollowing($user) ? 'Unfollow Me' : 'Follow Me' }}
        </x-button>

    </form>
@endunless
