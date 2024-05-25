<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\VoitingController;
use App\Http\Controllers\AdminController;

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

Route::get('/', [MainController::class, 'index'])->name('index');
Route::get('/about', [MainController::class, 'about'])->name('about');
Route::get('/addmusician', [MainController::class, 'addmusician'])->name('addmusician');
Route::post('/addmusician', [MainController::class, 'addNewMusician'])->name('add.new.musician');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginUser'])->name('login.user');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'registerUser'])->name('register.user');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/recover', [AuthController::class, 'recoverPassword'])->name('recover.user');

Route::get('/voiting', [VoitingController::class, 'voitingList'])->name('voiting.list');
Route::get('/voiting/{id}', [VoitingController::class, 'voitingView'])->name('voiting.view');
Route::get('/voiteadd/{voiting_id}/{musician_id}', [VoitingController::class, 'voiteAdd'])->name('voite.add');
Route::get('/voiting/{id}/result', [VoitingController::class, 'voitingResult'])->name('voiting.result');

Route::get('/admin', [AdminController::class, 'admin']);
Route::any('/admin/newvoiting', [AdminController::class, 'newVoiting'])->name('admin.newvoiting');
Route::get('/admin/accept/{id}', [AdminController::class, 'MusicianAccept'])->name('admin.musicianaccept');
Route::get('/admin/delete/{id}', [AdminController::class, 'MusicianDelete'])->name('admin.musiciandelete');