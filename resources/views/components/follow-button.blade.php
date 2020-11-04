@unless (current_user()->is($user))
    <form method="POST"
          action="/profiles/{{ $user->name }}/follow">

        @csrf

        <button type='submit'
                class="bg-blue-500 rounded-lg shadow py-2 px-4 text-white text-xs"
        >
            {{ current_user()->isFollowing($user) ? 'Unfollow Me' : 'Follow Me' }}
        </button>

    </form>
@endunless
