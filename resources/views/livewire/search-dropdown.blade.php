<div class="relative" x-data="{ isOpen: true }" @click.away="isOpen= false">
    <input
        wire:model.debounce.500ms="search"
        type="text"
        class="bg-gray-800 rounded-full text-sm w-64 px-4 pl-8 py-1 focus:outline-none focus:shadow-outline"
        placeholder="Search..."
        x-ref="search"
        @keydown.window="
            if(event.keyCode === 191){
                event.preventDefault();
                $refs.search.focus();
            }
        "
        @focus="isOpen = true"
        @keydown="isOpen = true"
        @keydown.escape.window="isOpen = false"
        @keydown.shift.tab="isOpen = false"
    />

    <div class="absolute top-0 flex items-center h-full ml-2">
        <svg class="fill-current text-gray-500 w-4" viewBox="0 0 24 24">
            <path class="heroicon-ui"
                  d="M16.32 14.9l5.39 5.4a1 1 0 01-1.42 1.4l-5.38-5.38a8 8 0
                                  111.41-1.41zM10 16a6 6 0 100-12 6 6 0 000 12z"/>
        </svg>
    </div>

    <div wire:loading class="spinner top-0 right-0 mt-3 mr-4"></div>

    @if(strlen($search) > 2)
         <div
             class="absolute bg-gray-800 text-sm rounded w-64 mt-2 z-50"
             x-show.transition.opacity="isOpen"
         >
             @if($searchResults->count() > 0)
                 <ul>
                     @foreach($searchResults as $movie)
                         <li class="border-gray-700 {{ $loop->last ? " ": "border-b" }}">
                             <a href="{{ route($movie['media_type'].'.show',$movie['id']) }}"
                                class="flex items-center block hover:bg-gray-700 px-3 py-3 transition ease-in-out duration-150"
                             >
                                 @if($movie['poster_path'])
                                     <img
                                         src="{{ "https://image.tmdb.org/t/p/w92" . $movie['poster_path'] }}"
                                         alt="{{ $movie['title'] }}"
                                         class="w-8"
                                     />
                                 @else
                                     <img
                                         src="https://via.placeholder.com/50x75"
                                         alt="{{ $movie['title'] }}"
                                         class="w-8"
                                     />
                                 @endif
                                 <p class="ml-4">{{ $movie['title'] }}</p>
                             </a>
                         </li>
                     @endforeach
                 </ul>
             @else
                 <div class="px-3 py-3">No results for "{{ $search }}"</div>
             @endif
         </div>
    @endif
</div>
