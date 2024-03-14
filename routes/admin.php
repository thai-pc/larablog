<?php

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

Route::resource('/admin/roles', RoleController::class)->names([
    'index' => 'backend.role.index',
    'create' => 'backend.role.create',
    'store' => 'backend.role.store',
    'edit' => 'backend.role.edit',
    'update' => 'backend.role.update',
    'destroy' => 'backend.role.destroy',
]);
