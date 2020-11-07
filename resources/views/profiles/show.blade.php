<x-app>
    <header class="mb-6 relative">
        <div class="relative">
            <img src="{{ $user->banner_image }}"
                 alt=""
                 class="mb-2"
                 width="700"
                 height="223"
                 style="max-height: 223px; max-width: 700px; border-radius: 3%;"
            >

            <img
                src="{{ $user->avatar }}"
                alt=""
                class="rounded-full mr-2 absolute bottom-0 transform -translate-x-1/2 translate-y-1/2"
                width="150"
                height="150"
                style="left: 50%; max-height: 150px"
            >
        </div>

        <div class="flex justify-between items-center mb-6">
            <div style="max-width: 270px;">
                <h2 class="font-bold text-2xl mb-0">{{ $user->name }}</h2>
                <p class="text-sm">Joined {{ $user->created_at->diffForHumans() }}</p>
            </div>

            <div class="flex">
                @can ('edit', $user)

                    <a href="{{ $user->path('edit') }}"
                       class="rounded-full border border-gray-300 py-2 px-4 text-black text-xs mr-2">Edit
                        Profile</a>
                @endcan

                <x-follow-button :user="$user"></x-follow-button>
            </div>

        </div>

        <p class="text-sm">

            {{ $user->description ?: "Eh ... What's up, doc?. No Bio yet, Follow me to know me" }}

        </p>

    </header>

    @include('_timeline', [
    'tweets' => $tweets
])

</x-app>



