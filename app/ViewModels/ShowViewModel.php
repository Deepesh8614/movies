<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class ShowViewModel extends ViewModel
{
    public $show;

    public function __construct($show)
    {
        $this->show = $show;
    }

    public function show(){
        return collect($this->show)->merge([
            'poster_path' => "https://image.tmdb.org/t/p/w500" . $this->show['poster_path'],
            'vote_average' => $this->show['vote_average'] * 10 .'%',
            'first_air_date' => Carbon::parse($this->show['first_air_date'])->format("M d, Y"),
            'genres' => collect($this->show['genres'])->pluck('name')->flatten()->implode(', '),
            'created_by' => collect($this->show['created_by'])->map(function ($creator){
               return collect($creator)->merge([
                 'profile_path' => $creator['profile_path']
                     ? "https://image.tmdb.org/t/p/w470_and_h470_face" . $creator['profile_path']
                     : "https://ui-avatars.com/api/?size=470&name=" . $creator['name'],
               ]);
            }),
            'cast' => collect($this->show['credits']['cast'])->take(5),
            'image' => collect($this->show['images']['backdrops'])->take(9),
        ]);
    }
}
