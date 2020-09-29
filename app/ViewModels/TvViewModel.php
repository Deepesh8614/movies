<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class TvViewModel extends ViewModel
{
    public $popularShows;
    public $topRatedShows;
    public $genres;

    public function __construct($popularShows, $topRatedShows, $genres)
    {
        $this->popularShows = $popularShows;
        $this->topRatedShows = $topRatedShows;
        $this->genres = $genres;
    }

    public function popularShows() {
        return $this->formatMovies($this->popularShows);
        //return collect($this->popularShows)->dump();
    }

    public function topRatedShows() {
        return $this->formatMovies($this->topRatedShows);
        //return collect($this->topRatedShows)->dump();
    }

    public function genres() {
        return $genres = collect($this->genres)->mapWithKeys(function ($genre) {
            return [$genre['id'] => $genre['name']];
        });
    }

    private function formatMovies($shows) {

        return collect($shows)->map(function ($show){

            $genresFormatted = collect($show['genre_ids'])->mapWithKeys(function ($value){
                return [$value => $this->genres()->get($value)] ;
            })->implode(', ');

            return collect($show)->merge([
                'poster_path' => "https://image.tmdb.org/t/p/w500" . $show['poster_path'],
                'vote_average' => $show['vote_average'] * 10 .'%',
                'first_air_date' => Carbon::parse($show['first_air_date'])->format("M d, Y"),
                'genres' => $genresFormatted,
            ])->only([
                'poster_path', 'vote_average', 'first_air_date', 'genres', 'id', 'name'
            ]);
        })->take(10);
    }
}
