<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\File;

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

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/home/receipt', 'CMS\ReceiptController@index')->name('receipt');
Route::post('/home/receipt/add', 'CMS\ReceiptController@add');
Route::get('/home/receipt/load', 'CMS\ReceiptController@load');
Route::post('/home/receipt/read', 'CMS\ReceiptController@read');
Route::post('/home/receipt/delete', 'CMS\ReceiptController@delete');
Route::post('/home/receipt/edit', 'CMS\ReceiptController@edit');
Route::get('/home/receipt-doc', 'CMS\ReceiptController@getDoc');

Route::get('/home/menu', 'CMS\MenuController@index')->name('menu');
Route::post('/home/menu/add', 'CMS\MenuController@add');
Route::get('/home/menu/load', 'CMS\MenuController@load');
Route::post('/home/menu/read', 'CMS\MenuController@read');
Route::post('/home/menu/delete', 'CMS\MenuController@delete');
Route::post('/home/menu/edit', 'CMS\MenuController@edit');

Route::get('/home/advice', 'CMS\AdviceController@index')->name('advice');
Route::post('/home/advice/add', 'CMS\AdviceController@add');
Route::get('/home/advice/load', 'CMS\AdviceController@load');
Route::post('/home/advice/read', 'CMS\AdviceController@read');
Route::post('/home/advice/delete', 'CMS\AdviceController@delete');
Route::post('/home/advice/edit', 'CMS\AdviceController@edit');

Route::get('/home/filter', 'CMS\FilterController@index')->name('filter');
Route::post('/home/filter/add', 'CMS\FilterController@add');
Route::get('/home/filter/load', 'CMS\FilterController@load');
Route::post('/home/filter/read', 'CMS\FilterController@read');
Route::post('/home/filter/delete', 'CMS\FilterController@delete');
Route::post('/home/filter/edit', 'CMS\FilterController@edit');

Route::get('/home/creating-filters', 'CMS\CreateFilterController@index')->name('create-filter');
Route::get('/home/creating-filter/load', 'CMS\CreateFilterController@load');
Route::post('/home/creating-filter/addType', 'CMS\CreateFilterController@addType');
Route::post('/home/creating-filter/addValue', 'CMS\CreateFilterController@addValue');
Route::post('/home/creating-filter/deleteType', 'CMS\CreateFilterController@deleteType');
Route::post('/home/creating-filter/deleteValue', 'CMS\CreateFilterController@deleteValue');
Route::post('/home/creating-filter/readTypes', 'CMS\CreateFilterController@readTypes');
Route::post('/home/creating-filter/readValues', 'CMS\CreateFilterController@readValues');
Route::post('/home/creating-filter/editTypes', 'CMS\CreateFilterController@editTypes');
Route::post('/home/creating-filter/editValues', 'CMS\CreateFilterController@editValues');

/*Route::get('storage/app/docs/load{filename}', function ($filename)
    {
        $path = storage_path('app/app/docs/load/' . $filename);

        if (!File::exists($path)) {
            abort(404);
        }

        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    });*/

});
