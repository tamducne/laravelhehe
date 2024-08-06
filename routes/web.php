<?php

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\CatalogueController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TestController;
use App\Http\Middleware\TestMiddleware;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::view('/', 'viewName');
//Đường daanx0 sau có name nó là chỉ đường
Route::resource('category', CategoryController::class);

Route::get('/admin', function(){
    return 'Đây là admin';
})->middleware('isAdmin');
// Auth::routes();
Route::get('/auth/login', [LoginController::class, 'showFormLogin'])->name('login');
Route::post('/auth/login',[LoginController::class, 'login']);
Route::post('/auth/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/auth/register', [RegisterController::class, 'showFormRegister'])->name('register');
Route::post('/auth/register',[RegisterController::class, 'register']);

Route::get('ahihi', [TestController::class,'ahihi'])->middleware(TestMiddleware::class);


Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::prefix('admin')
->as('admin.')
->group(function(){

    Route::get('/', function(){
            return view('admin.dashboard');
        })->name('dashboard')->middleware('isAdmin');

    Route::prefix('catalogues')
    ->as('catalogues.')
    ->group(function(){
        Route::get('/', [CatalogueController::class,'index'])->name('index');
        Route::get('/create', [CatalogueController::class,'create'])->name('create');
        Route::post('/store', [CatalogueController::class,'store'])->name('store');
        Route::get('/show/{id}', [CatalogueController::class,'show'])->name('show');
        Route::get('{id}/edit', [CatalogueController::class,'edit'])->name('edit');
        Route::put('/{id}/update', [CatalogueController::class,'update'])->name('update');
        Route::get('/{id}/destroy', [CatalogueController::class,'destroy'])->name('destroy');
    });
    Route::resource('categories',   CategoryController::class);
    Route::resource('products',     ProductController::class);
});
