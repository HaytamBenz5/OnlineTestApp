<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Student\QuizeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ConcoursController;
use App\Http\Controllers\Admin\SectorController;
use App\Http\Controllers\Admin\UserController;

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

Route::get('/', function () {
    return redirect('login');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware('role:admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'main'])->name('dashboard');

        Route::get('/List_users', [DashboardController::class, 'List_users'])->name('List_users');
        Route::get('/ViewUser/{id}', [UserController::class, 'ViewUser'])->name('ViewUser');
        Route::post('/EditUser/{id}', [UserController::class, 'EditUser'])->name('EditUser');
        Route::get('/deleteUser/{id}', [UserController::class, 'deleteUser'])->name('deleteUser');
        Route::get('/UserResultat/{id}', [UserController::class, 'UserResultat'])->name('UserResultat');

        Route::get('/filiere_section', [DashboardController::class, 'filiere_section'])->name('filiere_section');
        Route::get('/filiere_list', [DashboardController::class, 'filiere_list'])->name('filiere_list');
        Route::post('/insertFiliere', [SectorController::class, 'insertFiliere'])->name('insertFiliere');
        Route::get('/ViewFiliere/{id}', [SectorController::class, 'ViewFiliere'])->name('ViewFiliere');
        Route::post('/EditFiliere/{id}', [SectorController::class, 'EditFiliere'])->name('EditFiliere');
        Route::get('/deleteFiliere/{id}', [SectorController::class, 'deleteFiliere'])->name('deleteFiliere');

        Route::get('/exam_section', [DashboardController::class, 'exam_section'])->name('exam_section');
        Route::post('/insertExam', [ConcoursController::class, 'insertExam'])->name('insertExam');

        Route::get('/question_section', [DashboardController::class, 'question_section'])->name('question_section');
        Route::post('/insertQuestion', [ConcoursController::class, 'insertQuestion'])->name('insertQuestion');
    });

    Route::middleware('role:teacher')->group(function () {

    });

    Route::middleware('role:student')->group(function () {
        Route::get('/countdown', [QuizeController::class, 'countdown'])->name('countdown');
        Route::get('/exam', [QuizeController::class, 'main'])->name('exam');
        Route::get('/End', [QuizeController::class, 'EndExam'])->name('End');
        Route::match(['GET', 'POST'], '/getdata', [QuizeController::class, 'getdata'])->name('getdata');
    });
});

require __DIR__.'/auth.php';
