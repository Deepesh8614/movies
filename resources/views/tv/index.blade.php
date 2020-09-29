@extends('layouts.main')

@section('content')
    <div class="container mx-auto px-4 pt-16">

        <div class="popular-tv">
            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">Popular Shows</h2>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                @foreach($popularShows as $show)
                    <x-tv-card :show="$show" />
                @endforeach
            </div>
        </div>

        <div class="top-rated-shows mt-16">
            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">Top Rated Shows</h2>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                @foreach($topRatedShows as $show)
                    <x-tv-card :show="$show" />
                @endforeach
            </div>
        </div>
    </div>
@endsection