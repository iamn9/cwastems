<?php

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

Route::get('/', function () {
    return view('welcome');
});


/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function() {
        Route::prefix('admin-users')->name('admin-users/')->group(static function() {
            Route::get('/',                                             'AdminUsersController@index')->name('index');
            Route::get('/create',                                       'AdminUsersController@create')->name('create');
            Route::post('/',                                            'AdminUsersController@store')->name('store');
            Route::get('/{adminUser}/impersonal-login',                 'AdminUsersController@impersonalLogin')->name('impersonal-login');
            Route::get('/{adminUser}/edit',                             'AdminUsersController@edit')->name('edit');
            Route::post('/{adminUser}',                                 'AdminUsersController@update')->name('update');
            Route::delete('/{adminUser}',                               'AdminUsersController@destroy')->name('destroy');
            Route::get('/{adminUser}/resend-activation',                'AdminUsersController@resendActivationEmail')->name('resendActivationEmail');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function() {
        Route::get('/profile',                                      'ProfileController@editProfile')->name('edit-profile');
        Route::post('/profile',                                     'ProfileController@updateProfile')->name('update-profile');
        Route::get('/password',                                     'ProfileController@editPassword')->name('edit-password');
        Route::post('/password',                                    'ProfileController@updatePassword')->name('update-password');
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function() {
        Route::prefix('roles')->name('roles/')->group(static function() {
            Route::get('/',                                             'RolesController@index')->name('index');
            Route::get('/create',                                       'RolesController@create')->name('create');
            Route::post('/',                                            'RolesController@store')->name('store');
            Route::get('/{role}/edit',                                  'RolesController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'RolesController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{role}',                                      'RolesController@update')->name('update');
            Route::delete('/{role}',                                    'RolesController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function() {
        Route::prefix('bins')->name('bins/')->group(static function() {
            Route::get('/',                                             'BinsController@index')->name('index');
            Route::get('/create',                                       'BinsController@create')->name('create');
            Route::post('/',                                            'BinsController@store')->name('store');
            Route::get('/{bin}/edit',                                   'BinsController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'BinsController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{bin}',                                       'BinsController@update')->name('update');
            Route::delete('/{bin}',                                     'BinsController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function() {
        Route::prefix('bin-relationships')->name('bin-relationships/')->group(static function() {
            Route::get('/',                                             'BinRelationshipsController@index')->name('index');
            Route::get('/create',                                       'BinRelationshipsController@create')->name('create');
            Route::post('/',                                            'BinRelationshipsController@store')->name('store');
            Route::get('/{binRelationship}/edit',                       'BinRelationshipsController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'BinRelationshipsController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{binRelationship}',                           'BinRelationshipsController@update')->name('update');
            Route::delete('/{binRelationship}',                         'BinRelationshipsController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function() {
        Route::prefix('bin-statuses')->name('bin-statuses/')->group(static function() {
            Route::get('/',                                             'BinStatusesController@index')->name('index');
            Route::get('/create',                                       'BinStatusesController@create')->name('create');
            Route::post('/',                                            'BinStatusesController@store')->name('store');
            Route::get('/{binStatus}/edit',                             'BinStatusesController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'BinStatusesController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{binStatus}',                                 'BinStatusesController@update')->name('update');
            Route::delete('/{binStatus}',                               'BinStatusesController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function() {
        Route::prefix('client-complaints')->name('client-complaints/')->group(static function() {
            Route::get('/',                                             'ClientComplaintsController@index')->name('index');
            Route::get('/create',                                       'ClientComplaintsController@create')->name('create');
            Route::post('/',                                            'ClientComplaintsController@store')->name('store');
            Route::get('/{clientComplaint}/edit',                       'ClientComplaintsController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'ClientComplaintsController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{clientComplaint}',                           'ClientComplaintsController@update')->name('update');
            Route::delete('/{clientComplaint}',                         'ClientComplaintsController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function() {
        Route::prefix('complaint-statuses')->name('complaint-statuses/')->group(static function() {
            Route::get('/',                                             'ComplaintStatusesController@index')->name('index');
            Route::get('/create',                                       'ComplaintStatusesController@create')->name('create');
            Route::post('/',                                            'ComplaintStatusesController@store')->name('store');
            Route::get('/{complaintStatus}/edit',                       'ComplaintStatusesController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'ComplaintStatusesController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{complaintStatus}',                           'ComplaintStatusesController@update')->name('update');
            Route::delete('/{complaintStatus}',                         'ComplaintStatusesController@destroy')->name('destroy');
        });
    });
});