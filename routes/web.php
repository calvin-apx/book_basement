<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

Route::prefix('products')->group(function () {
    Route::name('products.')->group(function () {
        Route::get('/', "BookInformationController@index")->name('index');
        Route::post('add',"BookInformationController@store")->name('add');
        Route::post('genreAdd',"BookGenreController@store")->name('addGenre');
        Route::get('list',"BookInformationController@getBookInfo")->name('list');
        Route::get('find/{id}',"BookInformationController@find")->name('find');
        Route::post('update',"BookInformationController@update")->name('update');
        Route::post('delete',"BookInformationController@delete")->name('delete');
        Route::post('findFiltered',"BookInformationController@findFiltered")->name('findFiltered');
    });
});

Route::prefix('genres')->group(function () {
    Route::name('genres.')->group(function () {
        Route::get('data',"BookGenreController@getGenres")->name('data');
    });
});

Route::prefix('appointments')->group(function () {
    Route::name('appointments.')->group(function () {

        Route::get('/',"AppointmentController@index")->name('index');
        Route::get('find/{id}',"AppointmentController@find")->name('find');
        Route::post('cancel',"AppointmentController@cancel")->name('cancel');
        Route::post('done',"AppointmentController@done")->name('done');
        Route::get('data/{user_id}',"AppointmentController@data")->name('data');


        Route::prefix('donate')->group(function () {
            Route::post('donateStore',"AppointmentController@donateStore")->name('donateStore');
        });

        Route::prefix('buy')->group(function () {
            Route::post('buyStore',"AppointmentController@buyStore")->name('buyStore');
        });

        Route::prefix('sell')->group(function () {
            Route::post('sell',"AppointmentController@sell")->name('sell');
        });
    });
});

Route::prefix('cartList')->group(function () {
    Route::name('cartList.')->group(function () {
        Route::post('store',"CartListController@store")->name('store');
        Route::get('data/{id}',"CartListController@data")->name('data');
        Route::post('remove',"CartListController@remove")->name('remove');
    });
});

Route::prefix('favorites')->group(function () {
    Route::name('favorites.')->group(function () {
        Route::post('store',"FavoriteController@store")->name('store');
        Route::get('data/{user_id}',"FavoriteController@data")->name('data');
        Route::post('remove',"FavoriteController@remove")->name('remove');
    });
});

Route::prefix('recommendation')->group(function () {
    Route::name('recommendation.')->group(function () {
        // Route::get('data',"BookRecommendationController@getTopBookRecommendation")->name('data');
        Route::get('data',"BookRecommendationController@getbook")->name('data');
        Route::get('dataGenre/{id}',"BookRecommendationController@getByGenreRecommendation")->name('dataGenre');
    });
});

Route::prefix('user')->group(function () {
    Route::name('user.')->group(function () {
        // Route::get('data',"BookRecommendationController@getTopBookRecommendation")->name('data');
        Route::post('register',"UserController@register")->name('register');
        Route::post('checkUser',"UserController@checkUser")->name('checkUser');
    });
});



Auth::routes();

Route::get('home', 'HomeController@index')->name('home');

