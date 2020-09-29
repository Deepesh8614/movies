<div class="mt-8">
    <a href="{{ route('tvs.show', $show['id']) }}">
        <img src="{{ $show['poster_path'] }}" alt="{{ $show['name'] }}" class="hover:opacity-75 transition ease-in-out duration-150" />
    </a>
    <div class="mt-2">
        <a href="{{ route('tvs.show', $show['id']) }}" class="text-lg mt-2 hover:text-gray-300">{{ $show['name'] }}</a>
        <div class="flex items-center text-gray-400 text-sm mt-1">
            <img src="/images/star.svg" alt="star" class="w-3">
            <span class="ml-1">{{ $show['vote_average'] }}</span>
            <span class="mx-2">|</span>
            <span>{{ $show['first_air_date'] }}</span>
        </div>
        <div class="text-gray-400 text-sm">{{ $show['genres'] }}</div>
    </div>
</div>
