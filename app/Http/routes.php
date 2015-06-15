<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/



	Route::get('articles','ArticleController@index');
	Route::get('articles/create','ArticleController@create');

    Route::post('articles/uploadFile','ArticleController@uploadFile');
    Route::get('articles/uploadFile','ArticleController@uploadFile');

    Route::post('articles/list/','ArticleController@listout');
    Route::get('articles/list','ArticleController@listout');

    Route::get('articles/list_name_check/','ArticleController@listNameCheck');
    Route::get('articles/list_name_check','ArticleController@listNameCheck');

    Route::get('articles/show_list','ArticleController@showListFromDBAjaxCall');
    Route::post('articles/show_list/','ArticleController@showListFromDBAjaxCall');


    Route::get('articles/searchDescription','ArticleController@searchDescription');
    Route::post('articles/searchDescription/','ArticleController@searchDescription');

    Route::get('articles/list_show_only','ArticleController@showOnlyList');
    Route::post('articles/list_show_only/','ArticleController@showOnlyList');


