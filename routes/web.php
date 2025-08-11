<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\Admin;

// Route::get('/', function () {
//     return view('home');
// });



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::get('admin/dashboard', [HomeController::class, 'index'])->middleware(['auth', 'admin'])->name('admin.dasboard');

Route::get('/', [HomeController::class, 'home'])->name('root');

Route::get('/dashboard', [HomeController::class, 'login_home'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/myorders', [HomeController::class, 'myorders'])->middleware(['auth', 'verified'])->name('total.myorders');

Route::get('view_category', [AdminController::class, 'view_category'])->middleware(['auth', 'admin'])->name('category.view');

Route::post('add_category', [AdminController::class, 'add_category'])->middleware(['auth', 'admin'])->name('category.add');

Route::get('delete_category/{id}', [AdminController::class, 'delete_category'])->middleware(['auth', 'admin'])->name('category.delete');
Route::get('edit_category/{id}', [AdminController::class, 'edit_category'])->middleware(['auth', 'admin'])->name('category.edit');
Route::post('update_category/{id}', [AdminController::class, 'update_category'])->middleware(['auth', 'admin'])->name('category.update');

Route::get('add_product', [AdminController::class, 'add_product'])->middleware(['auth', 'admin'])->name('product.add');

Route::post('upload_product', [AdminController::class, 'upload_product'])->middleware(['auth', 'admin'])->name('product.upload');
Route::get('view_product', [AdminController::class, 'view_product'])->middleware(['auth', 'admin'])->name('product.view');
Route::get('delete_product/{id}', [AdminController::class, 'delete_product'])->middleware(['auth', 'admin'])->name('product.delete');


Route::get('edit_product/{slug}', [AdminController::class, 'edit_product'])->middleware(['auth', 'admin'])->name('product.edit');


Route::post('update_product/{id}', [AdminController::class, 'update_product'])->middleware(['auth', 'admin'])->name('product.update');
Route::get('search_product', [AdminController::class, 'search_product'])->middleware(['auth', 'admin'])->name('product.search');

Route::get('product_details/{id}', [HomeController::class, 'product_details'])->name('product.details');

Route::get('add_cart/{id}', [HomeController::class, 'add_cart'])->middleware(['auth', 'verified'])->name('cart.add');
Route::get('my_cart', [HomeController::class, 'my_cart'])->middleware(['auth', 'verified'])->name('total.mycart');
Route::get('delete_cart/{id}', [HomeController::class, 'delete_cart'])->middleware([
    'auth'
])->name('delete.cart');
Route::post('confirm_order', [HomeController::class, 'confirm_order'])->middleware(['auth'])->name('order.confirm');

Route::controller(HomeController::class)->group(function () {

    Route::get('stripe/{value}', 'stripe');
    Route::get('stripe-payment-success', 'stripePost')->name('stripe.post');
});

Route::get('view_order', [AdminController::class, 'view_order'])->middleware(['auth'])->name('order.view');
Route::get('on_the_way/{id}', [AdminController::class, 'on_the_way'])->middleware(['auth', 'admin'])->name('onTheWay');
Route::get('delivered/{id}', [AdminController::class, 'delivered'])->middleware(['auth', 'admin'])->name('delivered.order');
Route::get('print_pdf/{id}', [AdminController::class, 'print_pdf'])->middleware(['auth', 'admin'])->name('print.pdf');

Route::get('shop', [HomeController::class, 'shop'])->name('my.shop');
Route::get('why', [HomeController::class, 'why'])->name('why.me');
Route::get('testimonial', [HomeController::class, 'testimonial'])->name('testimonial');
Route::get('contact', [HomeController::class, 'contact'])->name('contact.us');
