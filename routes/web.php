<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\nft;
use App\Models\Nfts;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\Http;

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
    function filter_past_dates($array, $date_field) {
       return array_filter($array, function($element) use($date_field) {
            $date = new DateTime($element[$date_field]);
            return $date > new DateTime();
        });
    }
    $response = Http::get('https://api-mainnet.magiceden.dev/v2/collections?offset=0&limit=20');
    $cols = array_slice($response->json(), 0, 15);

    $response2 = Http::get('https://api-mainnet.magiceden.dev/v2/launchpad/collections?offset=0&limit=500');
    $filtered_by_date = filter_past_dates($response2->json(), 'launchDatetime');
    $dropsCount = count($filtered_by_date);
    $drops = array_slice($filtered_by_date, 0, 8);
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
        'nfts' => $items,
        'cols' => $cols,
        'drops' => $drops,
        'dropsCount' => $dropsCount
    ]);
})->name('/');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/contact', function () {
    return Inertia::render('Contact');
})->name('contact');

Route::get('/nfts', function () {
    return Inertia::render('Allnfts');
})->name('/nfts');
Route::get('/users/count', [RegisteredUserController::class, 'count'])->name('users/count');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::controller(nft::class)->group(function () {
    Route::get('/nfts/all', 'index')->name('nfts/all');
    Route::get('/nfts/list', 'index')->name('nfts/list');
    Route::get('/nfts/paginate', 'paginate')->name('nfts/paginate');
    Route::post('/nfts/nft', 'view')->name('nfts/nft');
    Route::get('/nfts/eth', 'eth')->name('nfts/eth');
    Route::get('/nfts/solana', 'solana')->name('nfts/solana');
    Route::get('/nfts/upcoming', 'upcoming')->name('nfts/upcoming');
    Route::get('/nfts/collection', 'collections')->name('/collection');
});
Route::controller(nft::class)->middleware(['auth', 'verified'])->group(function () {
    Route::post('/nfts/store', 'store')->name('nfts/store');
    Route::get('/nfts/count', 'count')->name('nfts/count');
    Route::post('/nfts/destroy', 'destroy')->name('nfts/destroy');
});

require __DIR__.'/auth.php';
