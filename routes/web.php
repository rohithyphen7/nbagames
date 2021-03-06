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

Route::get('/', function () {
    return view('game');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/teams', 'TeamsController@index');
Route::get('/getTeamsWithGroups', 'GroupsController@index');
Route::get('/getTeamsPlayers/{id}', 'TeamsController@show');
Route::get('/game', 'GameController@setMatches');
Route::get('/getMatches', 'GameController@index');
Route::get('/playingPlayers/{teamAId}/{teamBId}', 'TeamsController@getPlayers');
Route::get('/topPlayersView', 'TeamsController@getTopPlayersView');
Route::get('/getTopPlayers', 'TeamsController@getTopPlayers');
Route::get('/teamRanking', 'TeamsController@teamRankingView');
Route::get('/getTopTeams', 'TeamsController@getTopTeams');

//Route::get('/startGame', function () {
//    Artisan::queue('start:game');
//});
//Route::get('/startGame', 'GameController@create');






