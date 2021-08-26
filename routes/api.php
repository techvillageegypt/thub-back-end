<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::get('test', 'MainController@test');

// Authentication
// Route::post('forgotPassword', '\App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail');



//////////////////////////////////////////////////////////////////////////////
//////////////////////////////// Start Page //////////////////////////////////
//////////////////////////////////////////////////////////////////////////////

Route::get('pages/{id}', 'MainController@pages');
Route::get('informations', 'MainController@informations');
Route::get('metas', 'MainController@metas');
Route::get('blogs', 'MainController@blogs');
Route::get('blog/{id}', 'MainController@blog');
Route::get('faqs', 'MainController@faqs');
Route::get('colors', 'MainController@colors');
Route::get('categories', 'MainController@categories');
Route::post('send-contact', 'MainController@send_contact_message');
Route::post('newsletter', 'MainController@newsletter');
Route::get('landing-page', 'MainController@landing_page');






Route::get('options', 'MainController@options');
Route::get('states', 'MainController@states');
Route::get('donation-types', 'MainController@donation_types');

//////////////////////////////////////////////////////////////////////////////
///////////////////////////////// End Page ///////////////////////////////////
//////////////////////////////////////////////////////////////////////////////



//////////////////////////////////////////////////////////////////////////////
///////////////////////////////// Shop ///////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////

Route::get('app-home', 'ShopController@appHome');
Route::get('category-products/{category}', 'ShopController@categoryProducts');

Route::get('categories', 'ShopController@categories');
Route::get('sizes', 'ShopController@sizes');
Route::get('colors', 'ShopController@colors');
Route::get('products', 'ShopController@products');
Route::get('product/{id}', 'ShopController@product');
Route::get('random-products', 'ShopController@randomProducts');
Route::get('max-price', 'ShopController@maxPrice');

//////////////////////////////////////////////////////////////////////////////
///////////////////////////////// End Shop ///////////////////////////////////
//////////////////////////////////////////////////////////////////////////////


// Auth
// Route::post('customer/login', 'AuthController@login_or_register_customer');
// Route::post('customer/verify-code', 'AuthController@verify_code_customer');

// Auth
Route::post('user/login', 'AuthController@login_or_register_user');
Route::post('user/verify-code', 'AuthController@verify_code_user');
Route::post('user/update-device-id', 'AuthController@updateDeviceId');

// Route::post('driver/login', 'AuthController@login_or_register_driver');
// Route::post('driver/verify-code', 'AuthController@verify_code_driver');


//////////////////////////////////////////////////////////////////////////////
/////////////////////////////// Start Customer ///////////////////////////////
//////////////////////////////////////////////////////////////////////////////

Route::group(['middleware' => ['auth:api']], function () {

    Route::post('logout', 'AuthController@logout')->name('users.logout');

    Route::post('customer-update-information', 'CustomerController@update_information');
    Route::post('customer-update-phone', 'CustomerController@update_phone');
    Route::post('customer-verify-phone', 'CustomerController@verify_phone');
    Route::post('donate', 'CustomerController@donate');
    Route::post('customer-add-or-update-rate', 'CustomerController@addOrUpdateRate');
    Route::get('customer-wallet', 'CustomerController@wallet');
    Route::get('customer-donations', 'CustomerController@donations');

    Route::post('customer-feedback/{Donation}', 'CustomerController@donationFeedback');

    // Rate
    Route::post('add-or-update-rate', 'CustomerController@addOrUpdateRate');

    // Cart
    Route::post('toggle-cart', 'ShopController@toggleCart');
    Route::post('update-cart', 'ShopController@updateCart');
    Route::get('my-cart', 'ShopController@myCart');

    // wishlist
    Route::post('toggle-wishlist', 'ShopController@toggleWishlist');
    Route::get('my-wishlist', 'ShopController@myWishlist');
    Route::get('my-orders', 'ShopController@myOrders');

    // Checkout
    Route::post('checkout', 'ShopController@checkout');





    // Driver
    Route::post('driver-update-information', 'DriverController@update_information');

    Route::post('picked-up/{Donation}', 'DriverController@picked_up');
    Route::post('not-picked-up/{Donation}', 'DriverController@not_picked_up');
    Route::post('delevered/{Donation}', 'DriverController@delevered');
    Route::post('reschedule/{Donation}', 'DriverController@reschedule');
    Route::post('daily-weight', 'DriverController@dailyWeight');
    Route::get('driver-orders', 'DriverController@my_orders');

    Route::post('ecommerce-delevered/{order}', 'DriverController@ecommerce_delevered');
    Route::post('ecommerce-not-delevered/{order}', 'DriverController@ecommerce_not_delevered');
    Route::get('driver-ecommerce-orders', 'DriverController@my_ecommerce_orders');
    Route::get('user-notifications', 'CustomerController@notifications');
});

//////////////////////////////////////////////////////////////////////////////
/////////////////////////////// End Customer /////////////////////////////////
//////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////
////////////////////////////// Start Driver //////////////////////////////////
//////////////////////////////////////////////////////////////////////////////

Route::group(['middleware' => ['auth:api.driver']], function () {

    Route::post('driver-update-information', 'DriverController@update_information');

    Route::group(['middleware' => ['customeAuthProcess:driver']], function () {

        Route::get('driver-wallet', 'DriverController@wallet');

        Route::get('driver-notifications', 'DriverController@notifications');
        Route::get('driver-notifications', 'DriverController@notifications');
        Route::get('driver-notifications/{notification}', 'DriverController@notification');
        Route::post('driver-update-location', 'DriverController@update_my_location');

        Route::post('driver-add-or-update-rate', 'DriverController@addOrUpdateRate');
    });
});

//////////////////////////////////////////////////////////////////////////////
/////////////////////////////// End Driver ///////////////////////////////////
//////////////////////////////////////////////////////////////////////////////
