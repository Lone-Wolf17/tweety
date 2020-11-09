<div class="flex p-4 {{ $loop->last ? '' : 'border-b border-b-gray-400'}}">

    <div class="mr-2 flex-shrink-0">
        <a href="{{ $tweet->user->path() }}"><img
                src="{{ $tweet->user->avatar }}"
                alt=""
                class="rounded-full mr-2"
                width="50"
                size="50"
                height="50"
            ></a>
    </div>

    <div class="flex-1">
        <div class="flex justify-between">
            <h5 class="font-weight-bold mb-4">
                <a href="{{ $tweet->user->path() }}">{{ $tweet->user->name }}</a>
            </h5>

            @can('destroy', $tweet)
                <form method="POST" action="/tweets/{{$tweet->id}}">
                    @method('DELETE')
                    @csrf

                    <button type="submit">
                        <svg viewBox="0 0 20 20" class=" m-1 w-3">
                            <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g class="fill-current">
                                    <path
                                        d="M2,2 L18,2 L18,4 L2,4 L2,2 Z M8,0 L12,0 L14,2 L6,2 L8,0 Z M3,6 L17,6 L16,20 L4,20 L3,6 Z M8,8 L9,8 L9,18 L8,18 L8,8 Z M11,8 L12,8 L12,18 L11,18 L11,8 Z"
                                        id="Combined-Shape"></path>
                                </g>
                            </g>
                        </svg>
                    </button>
                </form>
            @endcan


        </div>

        <p class="text-sm mb-3">
            {{ $tweet->body }}
        </p>

        <x-like-buttons :tweet="$tweet"/>

    </div>
</div>
