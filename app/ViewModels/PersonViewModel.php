<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class PersonViewModel extends ViewModel
{
    public $person;
    public $social;
    public $credits;

    public function __construct($person, $social, $credits)
    {
        $this->person = $person;
        $this->social = $social;
        $this->credits = $credits;
    }

    public function person()
    {
        return collect($this->person)->merge([
            'birthday' => Carbon::parse($this->person['birthday'])->format('M d, Y'),
            'age' => Carbon::parse($this->person['birthday'])->age,
            'profile_path' => $this->person['profile_path']
                                ? 'https://image.tmdb.org/t/p/h632'.$this->person['profile_path']
                                : 'https://via.placeholder.com/421x632',
        ])->only('birthday', 'age', 'profile_path', 'name', 'id', 'biography', 'place_of_birth', 'homepage');
    }

    public function social()
    {
        return collect($this->social)->merge([
            'twitter' => $this->social['twitter_id'] ? 'https://twitter.com/' . $this->social['twitter_id'] : null,
            'facebook' => $this->social['facebook_id'] ? 'https://facebook.com/' . $this->social['facebook_id'] : null,
            'instagram' => $this->social['instagram_id'] ? 'https://instagram.com/' . $this->social['instagram_id'] : null,
         ])->only('twitter', 'facebook', 'instagram');
    }

    public function knownForTitles()
    {
        $castTitles = collect($this->credits)->get('cast');

        return collect($castTitles)->sortByDesc('popularity')->take(5)
            ->map(function ($cast){
                return collect($cast)->merge([
                   'poster_path' => $cast['poster_path']
                       ? 'https://image.tmdb.org/t/p/w185'.$cast['poster_path']
                       : 'https://via.placeholder.com/185x278',
                    'title' => isset($cast['title']) ? $cast['title'] : (isset($cast['name']) ? $cast['name'] : 'Untitled') ,
                ])->only('poster_path', 'title', 'id', 'media_type');
            });
    }

    public function credits()
    {
        $castTitles = collect($this->credits)->get('cast');

        return collect($castTitles)
            ->map(function ($cast){

                if(isset($cast['release_date'])){
                    $releaseDate = $cast['release_date'];
                } else if(isset($cast['first_air_date'])) {
                    $releaseDate = $cast['first_air_date'];
                } else {
                    $releaseDate = '';
                }

                if(isset($cast['title'])){
                    $title = $cast['title'];
                } else if(isset($cast['name'])) {
                    $title = $cast['name'];
                } else {
                    $title = 'Untitled';
                }


                return collect($cast)->merge([
                    'release_date' => $releaseDate,
                    'title' => $title,
                    'release_year' => isset($releaseDate) ? Carbon::parse($releaseDate)->format('Y') : 'Future',
                    'character' => isset($cast['character']) ? $cast['character'] : '',
                ]);
            })->sortByDesc('release_year');
    }
}
