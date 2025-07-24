<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use  App\Http\Controllers\GameController;
use App\Game;

Route::get('/', function () {
    $games = Game::orderBy('created_at', 'desc')->take(8)->get();
    $featured = Game::orderBy('created_at', 'desc')->take(3)->get();
    return view('home', compact('games', 'featured'));
});


Route::resource('games', 'GameController');
