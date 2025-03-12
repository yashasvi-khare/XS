<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


Route::middleware('auth:sanctum')->controller(App\Http\Controllers\ProductController::class)->group(function(){
    Route::get('index', 'index')->name('index');
    Route::get('get-product', 'getProduct')->name('getProduct');
    Route::get('trending-products', 'trendingProducts');
    Route::post('contact', 'contact');
    // Route::post('register', 'register');
    Route::get('product-details', 'product-details');
    Route::get('edit-product', 'editProduct')->name('editProduct');
    Route::post('create-product', 'createProduct')->name('createProduct');
    Route::post('update-product', 'updateProduct')->name('updateProduct');
});


Route::post('login', [AuthController::class, 'login']); 
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/user', [AuthController::class, 'user'])->middleware('auth:sanctum');



Route::middleware('auth:sanctum')->controller(App\Http\Controllers\CategoryController::class)->group(function(){
    Route::get('index', 'index')->name('index');
    Route::get('get-category', 'getCategory')->name('getCategory');
    Route::get('edit-category', 'editCategory')->name('editCategory');
    Route::post('create-category', 'createCategory')->name('createCategory');
    Route::post('update-category', 'updateCategory')->name('updateCategory');
});

Route::middleware('auth:sanctum')->controller(App\Http\Controllers\ReviewController::class)->group(function(){
    Route::get('index', 'index')->name('index');
    Route::get('get-review', 'getReview')->name('getReview');
    Route::get('edit-review', 'editReview')->name('editReview');
    Route::post('create-review', 'createReview')->name('createReview');
    Route::post('update-review', 'updateReview')->name('updateReview');
});
