<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});

Route::middleware('checklogin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'home'])->name('home');
    Route::get('/getEdit', [AdminController::class, 'getEdit'])->name('getEdit');
    Route::get('/addpro', [AdminController::class, 'addproView'])->name('addpro');
    Route::post('/addpro', [AdminController::class, 'addpro'])->name('addproduct');
    Route::get('/addcate', [AdminController::class, 'addcateView'])->name('addcateview');
    Route::post('/addcate', [AdminController::class, 'addcate'])->name('addcate');
    Route::get('/allcate', [AdminController::class, 'allcate'])->name('allcate');
    Route::get('/allpro', [AdminController::class, 'allpro'])->name('allpro');
    Route::get('/getedit/{id}', [AdminController::class, 'getedit_cate'])->name('getedit_cate');
    Route::post('/postedit/{id}', [AdminController::class, 'postedit_cate'])->name('postedit_cate');
    Route::get('/deletecate/{id}', [AdminController::class, 'deletecate'])->name('deletecate');
    Route::get('/deletepro/{id}', [AdminController::class, 'deletepro'])->name('deletepro');
    Route::get('/getedit_pro/{id}', [AdminController::class, 'getedit_pro'])->name('getedit_pro');
    Route::post('/postedit_pro/{id}', [AdminController::class, 'postedit_pro'])->name('postedit_pro');
});

Route::prefix('trangchu')->name('trangchu.')->group(function () {
    Route::get('/', [HomeController::class, 'homePage'])->name('homePage');
    Route::get('/loginView', [HomeController::class, 'loginView'])->name('loginView');
    Route::post('/login', [HomeController::class, 'login'])->name('login');
    Route::get('/registerView', [HomeController::class, 'registerView'])->name('registerView');
    Route::post('/register', [HomeController::class, 'register'])->name('register');
    Route::get('/san-pham', [HomeController::class, 'ProView'])->name('ProView');
    Route::get('/logout', [HomeController::class, 'logout'])->name('logout');
    Route::get('/detail/{id}', [HomeController::class, 'detailproduct'])->name('detailproduct');
});

Route::prefix('user')->middleware('addcart')->name('user.')->group(function () {
    Route::get('/', [HomeController::class, 'user'])->name('userpage');
    Route::get('/getEdit', [HomeController::class, 'getEdit'])->name('getEdit');
    Route::get('/getCart', [HomeController::class, 'getCart'])->name('getCart');
    Route::post('/addcart', [HomeController::class, 'addcart'])->name('addcart');
    Route::get('/xoasp/{id}', [HomeController::class, 'xoasp_cart'])->name('xoasp_cart');
    Route::post('/change', [HomeController::class, 'change'])->name('change');
    Route::post('/add_favorite', [HomeController::class, 'add_favorite'])->name('add_favorite');
    Route::get('/get_favorite', [HomeController::class, 'get_favorite'])->name('get_favorite');
    Route::post('/remove_favorite', [HomeController::class, 'remove_favorite'])->name('remove_favorite');
    Route::get('/personalpage', [HomeController::class, 'personalpage'])->name('personalpage');
    Route::get('/profile', [HomeController::class, 'profile'])->name('profile');
    Route::get('/editprofile', [HomeController::class, 'editpro'])->name('editprofile');
    Route::get('/favorite', [HomeController::class, 'favorite'])->name('favorite');
    Route::post('/order', [HomeController::class, 'order'])->name('order');
    Route::post('/edit', [HomeController::class, 'editprofile'])->name('edit');
    Route::get('/getorder', [HomeController::class, 'getorder'])->name('getorder');

});
