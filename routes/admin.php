<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\SiteOptionController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\User\CategoryController;
use App\Http\Controllers\User\PermissionController;
use App\Http\Controllers\User\PostController;
use App\Http\Controllers\User\RoleController;
use App\Http\Controllers\User\UserController;

Route::group([
    'middleware' => ['auth'],
    'prefix' => 'admin'
], function () {

    Route::view('/dashboard', 'backend.dashboard.index')->name('backend.dashboard');

//User Routes
    Route::resource('/users', UserController::class)->names([
        'index' => 'backend.user.index',
        'create' => 'backend.user.create',
        'store' => 'backend.user.store',
        'edit' => 'backend.user.edit',
        'update' => 'backend.user.update',
        'destroy' => 'backend.user.destroy',
    ]);

//Roles Routes
    Route::resource('/roles', RoleController::class)->names([
        'index' => 'backend.role.index',
        'create' => 'backend.role.create',
        'store' => 'backend.role.store',
        'edit' => 'backend.role.edit',
        'update' => 'backend.role.update',
        'destroy' => 'backend.role.destroy',
    ]);

    Route::get('/roles/{role}/assign-permission', [RoleController::class, 'assignPermissionView'])
        ->name('backend.role.assign.permission');

    Route::post('roles/{role}/assign-permission', [RoleController::class, 'assignPermission'])
        ->name('backend.role.store.permission');

//Permission Routes
    Route::resource('/permissions', PermissionController::class)->names([
        'index' => 'backend.permission.index',
        'create' => 'backend.permission.create',
        'store' => 'backend.permission.store',
        'edit' => 'backend.permission.edit',
        'update' => 'backend.permission.update',
        'destroy' => 'backend.permission.destroy',
    ]);

//Category Routes
    Route::resource('/categories', CategoryController::class)->names([
        'index' => 'backend.categories.index',
        'create' => 'backend.categories.create',
        'store' => 'backend.categories.store',
        'edit' => 'backend.categories.edit',
        'update' => 'backend.categories.update',
        'destroy' => 'backend.categories.destroy'
    ]);

    Route::get('/category/trashed', [CategoryController::class, 'trashedCategory'])
        ->name('backend.categories.trash');
    Route::post('/category/{category}/restore', [CategoryController::class, 'restoreCategory'])
        ->name('backend.categories.restore');
    Route::delete('/category/{category}/delete', [CategoryController::class, 'forceDeleteCategory'])
        ->name('backend.categories.force.delete');

//Posts Routes

    Route::resource('/posts', PostController::class)->names([
        'index' => 'backend.posts.index',
        'create' => 'backend.posts.create',
        'store' => 'backend.posts.store',
        'edit' => 'backend.posts.edit',
        'update' => 'backend.posts.update',
        'destroy' => 'backend.posts.destroy'
    ]);
    Route::match(['get', 'post'], 'admin/posts/upload', [PostController::class, 'uploadPhoto'])
        ->name('backend.posts.upload');
    Route::get('/post/trashed', [PostController::class, 'trashedPost'])
        ->name('backend.posts.trash');
    Route::post('/post/{post}/restore', [PostController::class, 'restorePost'])
        ->name('backend.posts.restore');
    Route::delete('/post/{post}/delete', [PostController::class, 'forceDeletePost'])
        ->name('backend.posts.force.delete');

//Tags Routes
    Route::resource('/tags', TagController::class)->names([
        'index' => 'backend.tags.index',
        'create' => 'backend.tags.create',
        'store' => 'backend.tags.store',
        'edit' => 'backend.tags.edit',
        'update' => 'backend.tags.update',
        'destroy' => 'backend.tags.destroy'
    ]);

    Route::get('/tag/trashed', [TagController::class, 'trashedTag'])
        ->name('backend.tags.trash');
    Route::post('/tag/{tag}/restore', [TagController::class, 'restoreTag'])
        ->name('backend.tags.restore');
    Route::delete('/tag/{tag}/delete', [TagController::class, 'forceDeleteTag'])
        ->name('backend.tags.force.delete');

    //Comments Routes
    Route::resource('/comments', CommentController::class)->names([
        'index' => 'backend.comments.index',
        'edit' => 'backend.comments.edit',
        'update' => 'backend.comments.update',
        'destroy' => 'backend.comments.destroy'
    ]);

    Route::put('/comment/{comment}/approve', [CommentController::class, 'approve'])
        ->name('backend.comments.approve');

    //Site settings
    Route::get('/site-settings', [SiteOptionController::class, 'index'])->name('backend.settings.index');
    Route::post('/site-settings', [SiteOptionController::class, 'store'])->name('backend.settings.store');
});
