<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\LoginGoogleController;
use App\Http\Controllers\MembershipCardController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\UserController;

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

// Route::get('/', [HomeController::class, 'index'])->name('home.index');
// Route::get('/product/{product}', [HomeController::class, 'index'])->name('home.product');

// Route::group(['prefix' => ''], function(){
//     Route::get('/',[HomeController::class, 'index'])->name('home.index');
// });


// Route::group(['prefix'=> 'admin','middleware' => ['auth', 'role:admin']], function()

Route::group(['prefix'=> 'admin','middleware' => ['auth', 'role:admin']], function(){
    Route::get('/',[AdminController::class, 'index'])->name('admin.index');

    Route::resources([
        'category' => CategoryController::class,
        'product' => ProductController::class,
        'user' => UserController::class,
    ]);

    Route::get('/orders', [OrderController::class, 'index'])->name('order.index');
    Route::get('/order/{id}', [OrderController::class, 'show'])->name('order.show');
    Route::get('orders/{id}/edit', [OrderController::class, 'edit'])->name('order.edit');
    Route::put('orders/{id}', [OrderController::class, 'update'])->name('order.update');
    Route::delete('/orders/{id}', [OrderController::class, 'destroy'])->name('order.destroy');

    Route::get('/contacts', [AdminController::class, 'contact'])->name('admin.contact');

});



// Route::get('login',[HomeController::class, 'login'])->name('home.login');
// Route::post('/login',[HomeController::class, 'check_login'])

Route::group(['prefix'=> 'cart'], function(){
    Route::get('/',[CartController::class, 'view'])->name('cart.view');

    Route::get('/add/{product}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::get('/delete/{id}', [CartController::class, 'deleteCart'])->name('cart.delete');
    Route::get('/update/{id}', [CartController::class, 'updateCart'])->name('cart.update');
});


Route::post('/cart/place-order', [OrderController::class, 'placeOrder'])->name('cart.placeOrder');




//login by gg account
Route::get('auth/google', [LoginGoogleController::class, 'redirectToGoogle'])->name('login-by-google');

Route::get('auth/google/callback', [LoginGoogleController::class, 'handleGoogleCallback']);

//comments
Route::post('/comment/{product_id}', [HomeController::class, 'post_comment'])->name('home.comment');


// clear gio hang
Route::get('/clear', [CartController::class, 'clearCart'])->name('cart.clear');

//contact email
// Route::get('/admin/contact', [HomeController::class], 'contact')->name('admin.contact');

//favorite: xu li khi an yeu thich
Route::get('/admin/favorite/{product}',[HomeController::class, 'favorite'])->name('admin.favorite');

//favorite: trang yeu thich
Route::get('/favorites', [FavoriteController::class, 'index'])->name('admin.favorite.index');

//render sp ra trang chu
Route::get('/', [HomeController::class, 'index'])->name('home');

// trang ve chung toi khi an nut xem them

// thanh toan vn pay
Route::post('/vnpay_payment', [PaymentController::class, 'vnpay_payment'])->name('vnpay_payment');
Route::get('/vnpay_return', [PaymentController::class, 'paymentReturn'])->name('payment.return');


Route::get('/payment-success', [PaymentController::class, 'paymentSuccess'])->name('payment.success');

//dang nhap user
// Route::get('/home/login',[HomeController::class, 'login'])->name('home.login');
// Route::post('/home/login',[HomeController::class, 'check_login']);

// Route::get('/home/register',[HomeController::class, 'register'])->name('home.register');
// Route::post('/home/register',[HomeController::class, 'check_register']);
// Route::get('/home/logout', [HomeController::class, 'logout'])->name('home.logout');
// Route::post('/home/logout', [HomeController::class, 'logout'])->name('home.logout');
Route::get('/verify-account/{email}', [HomeController::class, 'verify'])->name('account.verify');

Route::get('/login',[AdminController::class, 'login'])->name('login');
Route::post('/login',[AdminController::class, 'check_login']);

Route::get('/register',[AdminController::class, 'register'])->name('register');
Route::post('/register',[AdminController::class, 'check_register']);
Route::get('/logout', [AdminController::class, 'logout'])->name('logout');
Route::post('/logout', [AdminController::class, 'logout'])->name('logout');

Route::get('/admin/change-password', [AdminController::class, 'showChangePassWord'])->name('password_admin.change');
Route::post('/admin/change-password', [AdminController::class,'ChangePassword'])->name('password_admin.update');

Route::group(['prefix'=> 'home','middleware' => ['auth', 'role:user']], function(){


    Route::get('orders', [OrderController::class, 'userOrders'])->name('user.orders');
    Route::get('/order/{id}', [OrderController::class, 'showOrderUsers'])->name('orderUser.show');

    Route::get('/change-password', [HomeController::class, 'showChangePassWord'])->name('password.change');
    Route::post('change-password', [HomeController::class,'ChangePassword'])->name('password.update');

    Route::get('/contact', [HomeController::class, 'showContact'])->name('home.contact');
    Route::post('/contact', [HomeController::class, 'submitContact'])->name('contact.submit');

    Route::get('/about', [HomeController::class, 'about'])->name('about');

    //dua san pham ra trang san pham cua home
    Route::get('/product', [HomeController::class, 'products'])->name('products.index');

    // an chu mua ngay trang san pham ra trang chi tiet san pham
    Route::get('/product/{id}', [HomeController::class, 'showProduct'])->name('products.show');

    // yeu thich cua user
    Route::get('/favorites', [HomeController::class, 'Favorite_user'])->name('user.favorites');
    Route::get('/membership', [HomeController::class, 'showMembership'])->name('membership.index');

});






