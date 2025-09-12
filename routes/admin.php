<?php

use Illuminate\Support\Facades\Route;

use App\Livewire\Admin\Home;
use App\Livewire\Admin\Users;
use App\Livewire\Admin\Roles;
use App\Livewire\Admin\Permissions;

//Route::get('/admin', Admin::class)->name("admin")->middleware('auth');
Route::get('/admin/home', Home::class)->name("admin.home")->middleware('auth');
Route::get('/admin/users', Users::class)->name('admin.users')->middleware('auth');
Route::get('/admin/roles', Roles::class)->name('admin.roles')->middleware('auth');
Route::get('/admin/permissions', Permissions::class)->name('admin.permissions')->middleware('auth');
