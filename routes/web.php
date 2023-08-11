<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authorcontroller;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderConfirmationController;
use App\Http\Controllers\Searchcontroller;
use Illuminate\Support\Facades\Auth;

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

// Route::get('/roar', function () {
//     return view('welcome');
// });


Auth::routes();
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::view('/chart', 'admin.chart')->name('chart');
Route::get('/moreinfo/{id}', [Searchcontroller::class, 'moreinfobook'])->name('moreinfo');
Route::get('/books/search', 'App\Http\Controllers\SearchController@search')->name('books.search');
Route::get('/', [Itemcontroller::class, 'getItems'])->name('getItems');
Route::get('add/{id}', [ItemController::class, 'addToCheckout'])->name('item.addcheckout');
Route::get('/cart', [ItemController::class, 'viewCheckout'])->name('viewCheckout');
Route::get('/checkout/remove/{id}', 'ItemController@removeBookFromCheckout')->name('checkout.remove');
Route::get('/report', [DashboardController::class, 'index'])->name('most.used');
Route::get('/borrowed', [Itemcontroller::class, 'borrow'])->name('borrow');
Route::get('/reduce/{id}', [Itemcontroller::class, 'reduceQuantity'])->name('reduce');
Route::get('/add/{id}/quantity', [ItemController::class, 'addQuantity']);
// Route::patch('/book/restore/{id}', [ItemController::class, 'restore'])->name('book.restore');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');


Route::middleware(['auth'])->group(function () {
    Route::get('/transactions/download', 'DashboardController@download')->name('transactions.download');
    Route::get('/transactions/history', 'DashboardController@history')->name('user.history');
    Route::get('/order/return/{id}', 'App\Http\Controllers\OrderConfirmationController@returnbook')->name('order.return');
    Route::get('/checkout', [ItemController::class, 'checkout'])->name('checkout');
});


Route::middleware(['auth','role:1'])->group(function () {
    Route::prefix('admin')->group(function (){
    Route::post('genre/import', 'GenreController@import')->name('genre.import');
    Route::post('author/import', 'AuthorController@import')->name('author.import');
    Route::post('/media/book', 'BookController@storeMedia')->name('book.storeMedia');
    Route::post('/media/author', 'AuthorController@storeMedia')->name('author.storeMedia');
    Route::post('/media/stock', 'StockController@storeMedia')->name('stock.storeMedia');
    Route::post('/media/genre', 'GenreController@storeMedia')->name('genre.storeMedia');
    Route::view('/authors', 'author.index')->name('author.index');
    Route::view('/genres', 'genre.index')->name('genre.index');
    Route::view('/books', 'book.index')->name('book.index');
    Route::view('/stocks', 'stock.index')->name('stock.index');
    Route::resource('user', 'UserController');
    Route::get('/confirmation', 'App\Http\Controllers\OrderConfirmationController@orderconfirmation')->name('order.confirmation');
    Route::get('/confirm/{id}', 'App\Http\Controllers\OrderConfirmationController@confirm')->name('order.confirm');
    Route::get('/cancel/{id}', 'App\Http\Controllers\OrderConfirmationController@cancel')->name('order.cancel');
    Route::get('/booktable', 'App\Http\Controllers\BookController@booktable')->name('books.table');
    Route::get('/stocktable', 'App\Http\Controllers\BookController@stocktable')->name('stock.table');
    Route::get('/authortable', 'App\Http\Controllers\AuthorController@authortable')->name('author.table');

    });
});
