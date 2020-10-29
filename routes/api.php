<?php

use Illuminate\Http\Request;

Route::group(['namespace' => 'Api'], function(){
    Route::get('shorturl/', 'MainController@shortLink');
});
