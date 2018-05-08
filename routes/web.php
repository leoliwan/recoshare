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

// Users Auth
/* This authentication will prohibit users that are not register from accessing the website. Only register user can have access to 
the welcome page and homepage */
// Route::group(['middleware' =>['web', 'auth']], function() {
   

   
// });

Route::get('/', function () {
    $categories = App\Category::all();
    return view('welcome', compact('categories'));
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/home', 'HomeController@store')->name('home.store');

Route::get('/stockreco/{slug}', 'HomeController@stockreco')->name('stockreco');

Route::get('/category{slug}', 'HomeController@showcategories')->name('showcategories');

Route::post('/reco/like', 'LikeController@recolike')->name('recolike');

Route::post('rating/{reco}', 'RateController@postRating')->name('addrating');

Route::resource('/user', 'UserController');

Route::post('/search', 'SearchController@search')->name('search');

// Pages Route
Route::get('/disclaimer', 'PagesController@disclaimerPage')->name('disclaimer');

Route::get('/termsandconditions', 'PagesController@termsAndConditions')->name('termsandconditions');

Route::get('/about', 'PagesController@about')->name('about');


// Admin Auth
/* This authentication will allow admin to have access to AdminController, RecosController and CategoryController */
Route::group(['prefix' => 'admin', 'middleware' => ['admin', 'auth']], function () {
       
//Admin Route 
Route::resource('/', 'AdminController');

//Reco Route
Route::resource('/reco', 'RecosController');

Route::resource('/category', 'CategoryController');

Route::resource('/permission', 'PermissionController');

Route::resource('/bankpermission', 'BankPermissionController');

Route::delete('/reco/{id}', 'AdminController@destroy')->name('admin.destroy');

});


