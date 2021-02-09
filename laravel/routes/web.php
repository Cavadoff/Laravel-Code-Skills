<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestTestController;
//use App\Http\Controllers\Blog\PostController;
use App\Http\Controllers\Blog\Admin\PostController;
use App\Http\Controllers\Blog\Admin\CategoryController;
use App\Http\Controllers\DiggingDeeperController;

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
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('blog')->group (function (){
    Route::resource('posts', 'App\Http\Controllers\Blog\PostController')->names('blog.posts');
}
);

Route::prefix('digging_deeper')->group (function(){
    Route::get('collections','App\Http\Controllers\DiggingDeeperController@collections')->name('digging_deeper.collections');
});

//Route::resource('rest', 'RestTestController'::class);
//Route::resource('rest', 'App\Http\Controllers\RestTestController');


//admin blog
$groupData=[
    'namespace' => 'App\Http\Controllers\Blog\Admin',
    'prefix' =>'admin/blog',
];
Route::group($groupData,function(){
    $methods=['index','edit','update','create','store'];
    Route::resource('categories','CategoryController')
    ->only($methods)
    ->names('blog.admin.categories');

    Route::resource('posts','PostController')
    ->except(['show'])
    ->names('blog.admin.posts');

});



