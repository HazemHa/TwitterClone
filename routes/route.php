<?php
/*
|
---------------------------------------------------------
-----------------
| Web Routes
|
--------------------------------------------------------------------------
|
| Here is where you can register web routes for your 
application. These
| routes are loaded by the RouteServiceProvider within a 
group which
| contains the web middleware group. Now create 
something great!
|

/* 
Route::resources([
'/Likes' => 'LikesController'
]);
 */ 
 
 
 Route::get('/Likes', 'LikesController@ViewLikes'); 
Route::post('/Likes', 'LikesController@StoreLikes');
Route::put('/Likes', 'LikesController@UpdateLikes');
 // Route::patch('/Likes', 'LikesController@UpdateLikes');
Route::delete('/Likes', 'LikesController@DeleteLikes');
/* 
Route::resources([
'/Profiles' => 'ProfilesController'
]);
 */ 
 
 
 Route::get('/Profiles', 'ProfilesController@ViewProfiles'); 
Route::post('/Profiles', 'ProfilesController@StoreProfiles');
Route::put('/Profiles', 'ProfilesController@UpdateProfiles');
 // Route::patch('/Profiles', 'ProfilesController@UpdateProfiles');
Route::delete('/Profiles', 'ProfilesController@DeleteProfiles');
/* 
Route::resources([
'/Reply' => 'ReplyController'
]);
 */ 
 
 
 Route::get('/Reply', 'ReplyController@ViewReply'); 
Route::post('/Reply', 'ReplyController@StoreReply');
Route::put('/Reply', 'ReplyController@UpdateReply');
 // Route::patch('/Reply', 'ReplyController@UpdateReply');
Route::delete('/Reply', 'ReplyController@DeleteReply');
/* 
Route::resources([
'/Tweets' => 'TweetsController'
]);
 */ 
 
 
 Route::get('/Tweets', 'TweetsController@ViewTweets'); 
Route::post('/Tweets', 'TweetsController@StoreTweets');
Route::put('/Tweets', 'TweetsController@UpdateTweets');
 // Route::patch('/Tweets', 'TweetsController@UpdateTweets');
Route::delete('/Tweets', 'TweetsController@DeleteTweets');
/* 
Route::resources([
'/Users' => 'UsersController'
]);
 */ 
 
 
 Route::get('/Users', 'UsersController@ViewUsers'); 
Route::post('/Users', 'UsersController@StoreUsers');
Route::put('/Users', 'UsersController@UpdateUsers');
 // Route::patch('/Users', 'UsersController@UpdateUsers');
Route::delete('/Users', 'UsersController@DeleteUsers');
/* 
Route::resources([
'/PasswordResets' => 'PasswordResetsController'
]);
 */ 
 
 
 Route::get('/PasswordResets', 'PasswordResetsController@ViewPasswordResets'); 
Route::post('/PasswordResets', 'PasswordResetsController@StorePasswordResets');
Route::put('/PasswordResets', 'PasswordResetsController@UpdatePasswordResets');
 // Route::patch('/PasswordResets', 'PasswordResetsController@UpdatePasswordResets');
Route::delete('/PasswordResets', 'PasswordResetsController@DeletePasswordResets');
/* 
Route::resources([
'/Followers' => 'FollowersController'
]);
 */ 
 
 
 Route::get('/Followers', 'FollowersController@ViewFollowers'); 
Route::post('/Followers', 'FollowersController@StoreFollowers');
Route::put('/Followers', 'FollowersController@UpdateFollowers');
 // Route::patch('/Followers', 'FollowersController@UpdateFollowers');
Route::delete('/Followers', 'FollowersController@DeleteFollowers');

