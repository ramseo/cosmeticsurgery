<?php

/*
*
* Frontend Routes
*
* --------------------------------------------------------------------
*/
Route::group(['namespace' => '\Modules\Cms\Http\Controllers\Frontend', 'as' => 'frontend.', 'middleware' => 'web', 'prefix' => ''], function () {

    /*
     *
     *  Posts Routes
     *
     * ---------------------------------------------------------------------
     */
    $module_name = 'pages';
    $controller_name = 'PagesController';
    //    Route::get("pages", ['as' => "pages.index", 'uses' => "PagesController@index"]);
    Route::get("{slug?}", ['as' => "pages.show", 'uses' => "PagesController@show"]);
    Route::post("pages/lead_form", ['as' => "pages.lead_form", 'uses' => "PagesController@lead_form"]); 
    Route::post("pages/surgeon_filter", ['as' => "pages.surgeon_filter", 'uses' => "PagesController@surgeon_filter"]);

    //    /*
    //     *
    //     *  Categories Routes
    //     *
    //     * ---------------------------------------------------------------------
    //     */
    //    $module_name = 'categories';
    //    $controller_name = 'CategoriesController';
    //    Route::get("$module_name", ['as' => "$module_name.index", 'uses' => "$controller_name@index"]);
    //    Route::get("$module_name/{id}/{slug?}", ['as' => "$module_name.show", 'uses' => "$controller_name@show"]);
});

/*
*
* Backend Routes
*
* --------------------------------------------------------------------
*/
Route::group(['namespace' => '\Modules\Cms\Http\Controllers\Backend', 'as' => 'backend.', 'middleware' => ['web', 'auth', 'can:view_backend'], 'prefix' => 'admin'], function () {
    /*
    * These routes need view-backend permission
    * (good if you want to allow more than one group in the backend,
    * then limit the backend features by different roles or permissions)
    *
    * Note: Administrator has all permissions so you do not have to specify the administrator role everywhere.
    */

    /*
     *
     *  Posts Routes
     *
     * ---------------------------------------------------------------------
     */
    $module_name = 'pages';
    $controller_name = 'PagesController';
    Route::get("pages/index_list", ['as' => "pages.index_list", 'uses' => "PagesController@index_list"]);
    Route::get("pages/index_data", ['as' => "pages.index_data", 'uses' => "PagesController@index_data"]);
    Route::get("pages/trashed", ['as' => "pages.trashed", 'uses' => "PagesController@trashed"]);
    Route::patch("pages/trashed/{id}", ['as' => "pages.restore", 'uses' => "PagesController@restore"]);

    Route::get("pages/createcities", ['as' => "pages.createcities", 'uses' => "PagesController@createcities"]);
    Route::post("pages/storecities", ['as' => "pages.storecities", 'uses' => "PagesController@storecities"]);
    Route::post("pages/checkcity", ['as' => "pages.checkcity", 'uses' => "PagesController@checkcity"]);

    Route::resource("pages", "PagesController");

    Route::post("pages/menu_sort", ['as' => "pages.menu_sort", 'uses' => "PagesController@menu_sort"]);

    /*
     *
     *  Categories Routes
     *
     * ---------------------------------------------------------------------
     */
    //    $module_name = 'categories';
    //    $controller_name = 'CategoriesController';
    //    Route::get("$module_name/index_list", ['as' => "$module_name.index_list", 'uses' => "$controller_name@index_list"]);
    //    Route::get("$module_name/index_data", ['as' => "$module_name.index_data", 'uses' => "$controller_name@index_data"]);
    //    Route::get("$module_name/trashed", ['as' => "$module_name.trashed", 'uses' => "$controller_name@trashed"]);
    //    Route::patch("$module_name/trashed/{id}", ['as' => "$module_name.restore", 'uses' => "$controller_name@restore"]);
    //    Route::resource("$module_name", "$controller_name");
});
