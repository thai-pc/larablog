<?php

use App\Http\Controllers\User\CategoryController;
use App\Http\Controllers\User\PermissionController;
use App\Http\Controllers\User\PostController;
use App\Http\Controllers\User\RoleController;
use App\Http\Controllers\User\UserController;

Route::view('/admin/dashboard', 'backend.dashboard.index')->name('backend.dashboard');

//User Routes
Route::resource('/admin/users', UserController::class)->names([
    'index' => 'backend.user.index',
    'create' => 'backend.user.create',
    'store' => 'backend.user.store',
    'edit' => 'backend.user.edit',
    'update' => 'backend.user.update',
    'destroy' => 'backend.user.destroy',
]);

//Roles Routes
Route::resource('/admin/roles', RoleController::class)->names([
    'index' => 'backend.role.index',
    'create' => 'backend.role.create',
    'store' => 'backend.role.store',
    'edit' => 'backend.role.edit',
    'update' => 'backend.role.update',
    'destroy' => 'backend.role.destroy',
]);

Route::get('/admin/roles/{role}/assign-permission', [RoleController::class, 'assignPermissionView'])
    ->name('backend.role.assign.permission');

Route::post('/admin/roles/{role}/assign-permission', [RoleController::class, 'assignPermission'])
    ->name('backend.role.store.permission');

//Permission Routes
Route::resource('/admin/permissions', PermissionController::class)->names([
    'index' => 'backend.permission.index',
    'create' => 'backend.permission.create',
    'store' => 'backend.permission.store',
    'edit' => 'backend.permission.edit',
    'update' => 'backend.permission.update',
    'destroy' => 'backend.permission.destroy',
]);

//Category Routes
Route::resource('/admin/categories', CategoryController::class)->names([
    'index' => 'backend.categories.index',
    'create' => 'backend.categories.create',
    'store' => 'backend.categories.store',
    'edit' => 'backend.categories.edit',
    'update' => 'backend.categories.update',
    'destroy' => 'backend.categories.destroy'
]);

Route::get('/admin/category/trashed', [CategoryController::class, 'trashedCategory'])
    ->name('backend.categories.trash');
Route::post('/admin/category/{category}/restore', [CategoryController::class, 'restoreCategory'])
    ->name('backend.categories.restore');
Route::delete('/admin/category/{category}/delete', [CategoryController::class, 'forceDeleteCategory'])
    ->name('backend.categories.force.delete');

//Posts Routes

Route::resource('/admin/posts', PostController::class)->names([
    'index' => 'backend.posts.index',
    'create' => 'backend.posts.create',
    'store' => 'backend.posts.store',
    'edit' => 'backend.posts.edit',
    'update' => 'backend.posts.update',
    'destroy' => 'backend.posts.destroy'
]);
Route::match(['get', 'post'], 'admin/posts/upload', [PostController::class, 'uploadPhoto'])
    ->name('backend.posts.upload');
Route::get('/admin/post/trashed', [PostController::class, 'trashedPost'])
    ->name('backend.posts.trash');
Route::post('/admin/post/{post}/restore', [PostController::class, 'restorePost'])
    ->name('backend.posts.restore');
Route::delete('/admin/post/{post}/delete', [PostController::class, 'forceDeletePost'])
    ->name('backend.posts.force.delete');
