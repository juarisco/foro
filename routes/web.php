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
    return view('welcome');
});

Auth::routes();

Route::get('/forum', 'ForumsController@index')->name('forum');

Route::get('{provider}/auth', 'SocialsController@auth')->name('social.auth');

Route::get('/{provider}/redirect', 'SocialsController@auth_callback')->name('social.callback');

Route::get('discussion/{slug}', 'DiscussionsController@show')->name('discussion');

Route::get('category/{slug}', 'ForumsController@category')->name('category');


Route::group(['middleware' => 'auth'], function () {
    Route::resource('categories', 'CategoriesController');

    Route::get('discussion/create/new', 'DiscussionsController@create')->name('discussions.create');

    Route::post('discussion/store', 'DiscussionsController@store')->name('discussions.store');
    Route::post('discussion/reply/{id}', 'DiscussionsController@reply')->name('discussion.reply');

    Route::get('/reply/like/{id}', 'RepliesController@like')->name('reply.like');
    Route::get('/reply/unlike/{id}', 'RepliesController@unlike')->name('reply.unlike');
    Route::get('/reply/edit/{id}', 'RepliesController@edit')->name('reply.edit');
    Route::post('/reply/update/{id}', 'RepliesController@update')->name('reply.update');

    Route::get('/discussion/watch/{id}', 'WatchersController@watch')->name('discussion.watch');
    Route::get('/discussion/unwatch/{id}', 'WatchersController@unwatch')->name('discussion.unwatch');
    Route::get('/discussion/best/reply/{id}', 'RepliesController@best_answer')->name('discussion.best.answer');
    Route::get('/discussions/edit/{slug}', 'DiscussionsController@edit')->name('discussion.edit');
    Route::post('/discussions/update/{id}', 'DiscussionsController@update')->name('discussion.update');

});
