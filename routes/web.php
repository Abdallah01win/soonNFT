<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\nft;
use App\Http\Controllers\PostController;
use App\Models\Nfts;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;

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
function filter_badged($array, $isBadged)
    {
        return array_filter($array, function ($element) use ($isBadged) {
            return $element[$isBadged] === true;
        });
    }
function filter_past_dates($array, $date_field)
    {
        return array_filter($array, function ($element) use ($date_field) {
            $date = new DateTime($element[$date_field]);
            return $date > new DateTime();
        });
    }

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
            'added' => $item->created_at,
            'supply' => $item->supply,
            'is_featured' => $item->is_featured,
        ];
    });

    $client = new Client();
    $response = $client->get('https://api-mainnet.magiceden.dev/v2/collections?offset=0&limit=500');
    $firstData = array_slice(filter_badged(json_decode($response->getBody(), true), 'isBadged'), 0, 12);
    /*$combinedData = [];
    foreach($firstData as $item){
        $response = $client->get("https://api-devnet.magiceden.dev/v2/collections/{$item['symbol']}/stats");
        $secondData = json_decode($response->getBody(), true);
        $combinedData[] = array_merge($item, $secondData);
    };*/
    $featuredCount = Nfts::count();

    $response2 = Http::get('https://api-mainnet.magiceden.dev/v2/launchpad/collections?offset=0&limit=500');
    $filtered_by_date = filter_past_dates($response2->json(), 'launchDatetime');
    $dropsCount = count($filtered_by_date);
    $drops = array_slice($filtered_by_date, 0, 8);

    $posts = Post::join('users', 'users.id', '=', 'posts.userId')
        ->where('status', 1)
        ->limit(3)
        ->select('posts.*', 'users.name', 'users.image_url')
        ->get();

    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
        'nfts' => $items,
        'cols' => $firstData,
        'drops' => $drops,
        'posts' => $posts,
        'dropsCount' => $dropsCount,
        'featuredCount' => $featuredCount
    ]);
})->name('/');

Route::get('/upcoming', function () {
    $response2 = Http::get('https://api-mainnet.magiceden.dev/v2/launchpad/collections?offset=0&limit=500');
    $drops = filter_past_dates($response2->json(), 'launchDatetime');
    return Inertia::render('Upcoming', [
        'drops' => $drops,
    ]);
})->name('upcoming');
Route::get('/dashboard', function () {
    $comments = Comment::where('status', 2)
        ->select('id', 'comment',)
        ->get();
    return Inertia::render('Dashboard', ['comments' => $comments]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/contact', function () {
    return Inertia::render('Contact');
})->name('contact');


Route::get('/collections', function () {
    $client = new Client();
    $response = $client->get('https://api-mainnet.magiceden.dev/v2/collections?offset=0&limit=500');
    $firstData = filter_badged(json_decode($response->getBody(), true), 'isBadged');
    return Inertia::render('Collections', [
        'cols' => $firstData,
    ]);
})->name('/collections');

Route::get('/nfts', function () {
    return Inertia::render('Allnfts');
})->name('/nfts');
Route::get('/users/count', [RegisteredUserController::class, 'count'])->name('users/count');

Route::controller(nft::class)->group(function () {
    Route::get('/nfts/all', 'index')->name('nfts/all');
    Route::get('/nfts/list', 'index')->name('nfts/list');
    //Route::get('/nfts/paginate', 'paginate')->name('nfts/paginate');
    Route::post('/nfts/nft', 'view')->name('nfts/nft');
});
Route::controller(nft::class)->middleware(['auth', 'verified'])->group(function () {
    Route::post('/nfts/store', 'store')->name('nfts/store');
    Route::get('/nfts/count', 'count')->name('nfts/count');
    Route::post('/nfts/destroy', 'destroy')->name('nfts/destroy');
});
Route::controller(PostController::class)->group(function () {
    Route::get('/blog', 'index')->name('blog');
    Route::post('/post', 'show')->name('post');
    Route::get('/posts/count', 'count')->name('posts/count');
});

////--- Authonticated Routes

Route::middleware(['auth', 'verified'])->controller(CommentController::class)->group(function () {
    Route::post('/comment/creat', 'store')->name('comment/creat');
});
Route::middleware(['auth', 'verified'])->controller(PostController::class)->group(function () {
    Route::post('/posts/store', 'store')->name('posts/store');
    Route::post('/posts/destroy', 'destroy')->name('posts/destroy');
});
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
