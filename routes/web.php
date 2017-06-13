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




/* Admin Panel Routes */
Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function() {
	Route::get('/', function () {
    	return view('admin/home');
	});
	Route::resource('photos', 'PhotoController');
	Route::resource('sections', 'SectionController');
	Route::resource('comments', 'CommentController');
	Route::resource('users', 'UserController');

	Route::get('photos/{photo}/comments', 'CommentController@byPhoto')->name('commentsByPhoto');
	Route::get('users/{photo}/comments', 'CommentController@byUser')->name('commentsByUser');

});

/* HomePage Route */
Route::get('/', 'IndexController@index');
Route::get('/home', 'HomeController@index')->name('home');



/* Main Routes */	
Route::get('/photos', 'WebPhotoController@index');
Route::get('/photos/{photo}', 'WebPhotoController@show');
Route::post('/photos/{photo}/comments', 'WebCommentController@store');
Route::get('/photos/{photo}/comments', 'WebCommentController@index');
Route::get('/photos/{photo}/ajaxComments', 'WebCommentController@ajaxComments')->name('ajaxComments');
Route::delete('/comments/{comment}', 'WebCommentController@destroy')->name('webComments.destroy');

Route::get('/sections/{section}', 'WebSectionController@show');



/* Login Routes */
Route::get('login/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('login/{provider}/callback', 'Auth\LoginController@handleProviderCallback');

Auth::routes();



/* Error Page Route */
Route::get('/restricted', function(){
	return view('restricted');
})->name('restricted');




