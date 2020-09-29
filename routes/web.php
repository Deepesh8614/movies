<?php

use App\Http\Controllers\PeopleController;
use App\Http\Controllers\TvController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MoviesController;

Route::get("/", [MoviesController::class, 'index'])->name('movies.index');
Route::get("/movies/{id}", [MoviesController::class, 'show'])->name('movies.show');

Route::get("/tv", [TvController::class, 'index'])->name('tv.index');
Route::get("/tv/{id}", [TvController::class, 'show'])->name('tvs.show');

Route::get("/people", [PeopleController::class, 'index'])->name('people.index');
Route::get("/people/page/{id}", [PeopleController::class, 'index']);
Route::get("/people/{id}", [PeopleController::class, 'show'])->name('people.show');

