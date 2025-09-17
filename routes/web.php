<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Counter;
use App\Livewire\Principal;
use App\Livewire\Home;
use App\Livewire\Admin;
use App\Livewire\Users\Login;
use App\Livewire\Users\Registro;
use App\Livewire\Users\Logout;
//use App\Livewire\Admin\Users;
use App\Livewire\Users\Users;
use App\Livewire\Admin\Roles;
use App\Livewire\Users\CambioPassword;


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
/*
Route::get('/', function () {
    return view('welcome');
});
*/

//Route::get('/', Principal::class);
Route::get('/', Home::class);
Route::get('/counter', Counter::class);
Route::get('/home', Home::class);

/*
Route::get('/admin', Admin::class)->name("admin")->middleware('auth');
Route::get('/admin/home', Admin::class)->name("admin.home")->middleware('auth');
Route::get('/admin/users', Users::class)->name('admin.users')->middleware('auth');
Route::get('/admin/roles', Roles::class)->name('admin.roles')->middleware('auth');
*/

Route::get('/salir', Logout::class);
Route::get('/login', Login::class)->name('login');
Route::get('/logout', Logout::class)->name('logout');
Route::get('/registro', Registro::class);
Route::get('/users', Users::class)->name('users')->middleware('auth');
Route::get("/cambioPassword", CambioPassword::class)->name('cambioPassword')->middleware('auth');
//Route::get('/roles', \App\Livewire\Admin\Roles::class)->name('admin.roles')->middleware('auth');

Route::get("/dashboard", \App\Livewire\Dashboard\Index::class)->name('dashboard')->middleware('auth');
Route::get("/dashboard/crear", \App\Livewire\Dashboard\Crear::class)->name('dashboard.crear')->middleware('auth');
//Route::get("/dashboard.ver", \App\Livewire\Dashboard\Ver::class)->name('dashboard.ver')->middleware('auth');