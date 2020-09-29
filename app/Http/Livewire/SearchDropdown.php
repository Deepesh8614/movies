<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class SearchDropdown extends Component
{
    public $search = '';

    public function render()
    {
        $searchResults = [];
        if(strlen($this->search) > 2) {
            $searchResults = $popularMovies = Http::withToken(config('services.tmdb.token'))
                ->get("https://api.themoviedb.org/3/search/multi?query=" . $this->search)
                ->json()['results'];
        }

        //dump($searchResults);

        return view('livewire.search-dropdown',[
            "searchResults" => collect($searchResults)->map(function ($result){
                return collect($result)->merge([
                    'poster_path' => isset($result['poster_path']) ? $result['poster_path']
                        : ( isset($result['profile_path']) ? $result['profile_path'] : null ),
                    'title' => isset($result['title']) ? $result['title'] : $result['name'],
                    'media_type' => $result['media_type'] == 'movie' ? 'movies' : ($result['media_type'] == 'tv' ? 'tvs' : 'people')
                ]);
            })->take(8),
        ]);
    }
}
