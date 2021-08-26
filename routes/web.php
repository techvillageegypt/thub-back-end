<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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



Route::get('generator_builder', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@builder')->name('io_generator_builder');

Route::get('field_template', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@fieldTemplate')->name('io_field_template');

Route::get('relation_field_template', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@relationFieldTemplate')->name('io_relation_field_template');

Route::post('generator_builder/generate', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@generate')->name('io_generator_builder_generate');

Route::post('generator_builder/rollback', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@rollback')->name('io_generator_builder_rollback');

Route::post(
    'generator_builder/generate-from-file',
    '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@generateFromFile'
)->name('io_generator_builder_generate_from_file');

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/*
|--------------------------------------------------------------------------
| Admin Panel Routes
|--------------------------------------------------------------------------
*/

Route::group(
    [
        'prefix' => 'adminPanel',
        'namespace' => 'App\Http\Controllers\AdminPanel',
        'as' => 'adminPanel.'
    ],
    function () {

        Route::group(['middleware' => ['guest']], function () {

            Route::get('/login', 'AuthController@login')->name('login');
            Route::post('/login', 'AuthController@postLogin')->name('postLogin');
        });


        Route::group(['middleware' => ['auth:admin', 'permissionHandler']], function () {

            Route::get('logout', 'AuthController@logout')->name('logout');

            Route::get('/', 'DashboardController@dashboard')->name('dashboard');

            Route::resource('roles', 'RolesController');
            Route::get('updatePermissions', 'RolesController@updatePermissions')->name('roles.updatePermissions');


            Route::resource('admins', AdminController::class);
            Route::resource('metas', MetaController::class);

            Route::resource('drivers', DriverController::class);
            Route::patch('/deactivate/{driver}', 'DriverController@deactivate')->name('drivers.deactivate');

            Route::get('driver-weight', 'DriverWeightController@index')->name('driver_weights.index');
            Route::post('driver-weight-date-filter', 'DriverWeightController@dateFilter')->name('driver_weights.dateFilter');
            Route::patch('driver-update-weight/{id}', 'DriverWeightController@updateDriverWeight')->name('driver_weights.updateDriverWeight');
            Route::get('driver-weight-export', 'DriverWeightController@export')->name('driver_weights.export');
            Route::get('drivers-export', 'DriverController@export')->name('drivers.export');


            Route::prefix('customers')->as('customers.')->group(function () {
                Route::get('/', 'CustomerController@index')->name('index');
                Route::get('/{customer}', 'CustomerController@show')->name('show');
            });
            Route::get('customers-export', 'CustomerController@export')->name('customers.export');

            Route::prefix('donations')->as('donations.')->group(function () {
                Route::get('/', 'DonationController@index')->name('index');
                Route::get('/{donation}', 'DonationController@show')->name('show');
                Route::patch('/assign-driver/{donation}', 'DonationController@assign_driver')->name('assign_driver');
                Route::patch('/update-pickup-date/{donation}', 'DonationController@updatePickupDate')->name('updatePickupDate');
            });
            Route::post('donations-date-filter', 'DonationController@dateFilter')->name('donations.dateFilter');
            Route::get('donations-export', 'DonationController@export')->name('donations.export');

            Route::resource('socialLinks', SocialLinkController::class);
            Route::post('ckeditor/upload', 'CkeditorController@upload')->name('ckeditor.upload');
            Route::resource('information', InformationController::class);
            Route::resource('sliders', SliderController::class);
            Route::resource('contacts', ContactController::class);
            Route::get('newsletters', 'NewsletterController@index')->name('newsletters.index');
            Route::resource('blogs', BlogController::class);
            Route::resource('faqCategories', FaqCategoryController::class);
            Route::resource('faqs', FaqController::class);
            Route::resource('appFeatures', AppFeatureController::class);
            Route::resource('brands', BrandController::class);
            Route::resource('colors', ColorController::class);
            Route::resource('sizes', SizeController::class);

            // Pages CRUD
            Route::resource('pages', 'PageController');
            Route::resource('pages.paragraphs', 'ParagraphController')->shallow();
            Route::resource('pages.images', 'imagesController')->shallow();

            Route::resource('options', OptionController::class);

            Route::resource('notifications', NotificationController::class);

            Route::resource('categories', CategoryController::class);
            Route::resource('states', StateController::class);
            Route::resource('donationTypes', DonationTypeController::class);

            Route::resource('products', ProductController::class);
            Route::resource('productPhotos', ProductPhotoController::class);

            Route::delete('products/delete-item/{id}', 'ProductController@destroyItem')->name('products.destroy.item');

            Route::resource('orders', OrderController::class);
            Route::patch('/assign-driver/{order}', 'OrderController@assign_driver')->name('orders.assign_driver');

            Route::post('orders-date-filter', 'OrderController@dateFilter')->name('orders.dateFilter');
            Route::get('orders-export', 'OrderController@export')->name('orders.export');

            Route::patch('orders/delevered/{order}', 'OrderController@delevered')->name('orders.delevered');
        });
    }
);

///////////////////////////////////////////////////////////////////////////
///								End admin panel routes 					///
///////////////////////////////////////////////////////////////////////////
