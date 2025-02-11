<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
});
//Route::middleware(['2fa'])->group(function () {
Route::get('/dashboard', function () {
    return view('dashboard');
//    Route::post('/2fa', function () {
//
//        return redirect(route('home'));
//
//    })->name('2fa');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //Permissions
    Route::get('/permissions/create', [PermissionController::class, 'create'])->name('permissions.create');
    Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions.index');
    Route::post('/permissions/store', [PermissionController::class, 'store'])->name('permissions.store');
    Route::get('/permissions/edit/{id}', [PermissionController::class, 'edit'])->name('permissions.edit');
    Route::patch('/permissions/update/{id}', [PermissionController::class, 'update'])->name('permissions.update');
    Route::delete('/permissions/destroy/{id}', [PermissionController::class, 'destroy'])->name('permissions.delete');

    //Roles
    Route::get('/roles/create', [RolesController::class, 'create'])->name('roles.create');
    Route::get('/roles', [RolesController::class, 'index'])->name('roles.index');
    Route::post('/roles/store', [RolesController::class, 'store'])->name('roles.store');
    Route::get('/roles/edit/{id}', [RolesController::class, 'edit'])->name('roles.edit');
    Route::patch('/roles/update/{id}', [RolesController::class, 'update'])->name('roles.update');
    Route::delete('/roles/destroy/{id}', [RolesController::class, 'destroy'])->name('roles.delete');

    //Articles
    Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
    Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
    Route::post('/articles/store', [ArticleController::class, 'store'])->name('articles.store');
    Route::get('/articles/edit/{id}', [ArticleController::class, 'edit'])->name('articles.edit');
    Route::patch('/articles/update/{id}', [ArticleController::class, 'update'])->name('articles.update');
    Route::delete('/articles/destroy/{id}', [ArticleController::class, 'destroy'])->name('articles.delete');

    //Users
    Route::get('/users/create', [UsersController::class, 'create'])->name('users.create');
    Route::get('/users', [UsersController::class, 'index'])->name('users.index');
    Route::post('/users/store', [UsersController::class, 'store'])->name('users.store');
    Route::get('/users/edit/{id}', [UsersController::class, 'edit'])->name('users.edit');
    Route::patch('/users/update/{id}', [UsersController::class, 'update'])->name('users.update');
    Route::delete('/users/destroy/{id}', [UsersController::class, 'destroy'])->name('users.delete');

    //Categories
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::post('/categories/store', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/edit/{id}', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::patch('/categories/update/{id}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/destroy/{id}', [CategoryController::class, 'destroy'])->name('categories.delete');

    // Products
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/edit/{id}', [ProductController::class, 'edit'])->name('products.edit');
    Route::patch('/products/update/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/destroy/{id}', [ProductController::class, 'destroy'])->name('products.delete');

});

require __DIR__.'/auth.php';
