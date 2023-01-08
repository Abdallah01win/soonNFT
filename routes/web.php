<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\nft;
use App\Models\Nfts;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    $items = Nfts::paginate(10)->through(function ($item) {
        return [
            'id' => $item->id,
            'name' => $item->name,
            'website' => $item->website,
            'twitter' => $item->twitter,
            'discord' => $item->discord,
            'blockchain' => $item->blockchain,
            'price' => $item->price,
            'imgurl' => $item->imgurl,
            'dropdate' => $item->dropdate,
            'supply' => $item->supply,
        ];
    });
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
        'nfts' => $items
    ]);
})->name('/');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/contact', function () {
    return Inertia::render('Contact');
})->name('contact');
Route::get('/users/count', [RegisteredUserController::class, 'count'])->name('users/count');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::controller(nft::class)->middleware(['auth', 'verified'])->group(function () {
    Route::get('/nfts/list', 'index')->name('nfts/list');
    Route::post('/nfts/store', 'store')->name('nfts/store');
    Route::get('/nfts/count', 'count')->name('nfts/count');
    Route::get('/nfts/paginate', 'paginate')->name('nfts/paginate');
    Route::post('/nfts/destroy', 'destroy')->name('nfts/destroy');
});

require __DIR__.'/auth.php';
