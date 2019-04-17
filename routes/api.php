<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resources([
    'users' => 'UsersController',
    'tweets' => 'TweetsController',
    'reply' => 'ReplyController',
    'profiles' => 'ProfilesController',
    'followers' => 'FollowersController',
]);
Route::get('/myFuncitonUnderTest', 'UsersController@myFuncitonUnderTest');
Route::post('login', 'UsersController@Login');
Route::post('logout', 'UsersController@Logout');
Route::post('register', 'UsersController@store');
Route::post('profile', 'UsersController@updateProfile');
Route::get('checkMyLogin', 'UsersController@checkMyLogin');
Route::get('TagsData', 'TweetsController@TagsData');
Route::get('tweetsTag/{text}','TweetsController@tweetsTag');
Route::post('likeOrDisLike/{tweetID}', 'TweetsController@likeOrDisLike');
Route::get('TweetsFromFollowing', 'TweetsController@TweetsFromFollowing');
Route::get('UserStatistic', 'ProfilesController@UserStatistic');
Route::get('UserFoRSuggestions', 'UsersController@UserFoRSuggestions');
