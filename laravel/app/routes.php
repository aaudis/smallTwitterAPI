<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function(){ return View::make('hello'); });

Route::get("api/{name?}", "ApiController@sayHello");

// Social Controller
Route::get("social/add/{imei}/{sh1}", array("as" => "soacil_add", "uses" => "SocialController@get_add"));
Route::post("social/addav/{imei}/{sh1}", array("as" => "social_addav", "uses" => "SocialController@post_addav"));
Route::post("social/remav/{imei}/{sh1}", array("as" => "social_remav", "uses" => "SocialController@post_remav"));
Route::get("social/getuser/{imei}/{sh1}", array("as" => "social_getuser", "uses" => "SocialController@get_getuser"));
Route::get("social/getdata/{imei}/{sh1}", array("as" => "social_getdata", "uses" => "SocialController@get_getdata"));

// SocialLoupe API description
Route::get("hjas782ajhs29392kkaskaj293829kasj", "HomeController@socialLoupeAPI");
