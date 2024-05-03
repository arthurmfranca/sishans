<?php

use App\Http\Controllers\NotificacaoController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SobreController;


use Illuminate\Support\Facades\Route;

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

// LOGIN
Route::get('/', [LoginController::class, 'index'])->name('login.index');
Route::post('/login', [LoginController::class, 'loginProcess'])->name('login.process');
Route::get('/create-user-login', [LoginController::class, 'create'])->name('login.create-user');
Route::post('/store-user-login', [LoginController::class, 'store'])->name('login.store-user');

// RECUPERAR SENHA
Route::get('/forgot-password', [ForgotPasswordController::class, 'showForgotPassword'])->name('forgot-password.show');
Route::post('/forgot-password', [ForgotPasswordController::class, 'submitForgotPassword'])->name('forgot-password.submit');

Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showResetPassword'])->name('reset-password.show');
Route::post('/reset-password', [ForgotPasswordController::class, 'submitResetPassword'])->name('reset-password.submit');

Route::post('/', [LoginController::class, 'index'])->name('password.reset');

Route::group(['middleware' => 'auth'], function () {

    // LOGOUT
    Route::get('/logout', [LoginController::class, 'destroy'])->name('login.destroy');

    // DASHBOARD
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    // PERFIL
    Route::get('/show-profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/edit-profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/update-profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/edit-profile-password', [ProfileController::class, 'editPassword'])->name('profile.edit-password');
    Route::put('/update-profile-password', [ProfileController::class, 'updatePassword'])->name('profile.update-password');

    // USUÁRIOS
    Route::get('/index-user', [UserController::class, 'index'])->name('user.index');
    Route::get('/show-user/{user}', [UserController::class, 'show'])->name('user.show');
    Route::get('/create-user', [UserController::class, 'create'])->name('user.create');
    Route::post('/store-user', [UserController::class, 'store'])->name('user.store');
    Route::get('/edit-user/{user}', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/update-user/{user}', [UserController::class, 'update'])->name('user.update');
    Route::get('/get-hospitals-by-municipio', [UserController::class, 'getHospitalsByMunicipio']);
    Route::get('/edit-user-password/{user}', [UserController::class, 'editPassword'])->name('user.edit-password');
    Route::put('/update-user-password/{user}', [UserController::class, 'updatePassword'])->name('user.update-password');
    Route::delete('/destroy-user/{user}', [UserController::class, 'destroy'])->name('user.destroy');
    Route::get('/user-search', [UserController::class, 'search'])->name('user.search');

    Route::get('/create-new-password', [UserController::class, 'newPassword'])->name('user.newPassword');
    Route::put('/store-new-password', [UserController::class, 'storeNewPassword'])->name('user.storeNewPassword');

    // PACIENTE
    Route::get('/index-paciente', [PacienteController::class, 'index'])->name('paciente.index');
    Route::get('/show-paciente/{paciente}', [PacienteController::class, 'show'])->name('paciente.show');
    Route::get('/create-paciente', [PacienteController::class, 'create'])->name('paciente.create');
    Route::post('/store-paciente', [PacienteController::class, 'store'])->name('paciente.store');
    Route::get('/edit-paciente/{paciente}', [PacienteController::class, 'edit'])->name('paciente.edit');
    Route::put('/update-paciente/{paciente}', [PacienteController::class, 'update'])->name('paciente.update');
    Route::delete('/destroy-paciente/{paciente}', [PacienteController::class, 'destroy'])->name('paciente.destroy');
    Route::get('/paciente-search', [PacienteController::class, 'search'])->name('paciente.search');
    Route::get('/municipios/{estadoId}', [PacienteController::class, 'getMunicipiosEstado'])->name('getMunicipiosEstado');

    // NOTIFICAÇÃO
    Route::get('/index-notificacao/{paciente}', [NotificacaoController::class, 'index'])->name('notificacao.index');
    Route::get('/index-notificacao', [NotificacaoController::class, 'index2'])->name('notificacao.index2');
    Route::get('/show-notificacao/{notificacao}', [NotificacaoController::class, 'show'])->name('notificacao.show');
    Route::get('/create-notificacao/{paciente}', [NotificacaoController::class, 'create'])->name('notificacao.create');
    Route::post('/store-notificacao', [NotificacaoController::class, 'store'])->name('notificacao.store');
    Route::get('/edit-notificacao/{notificacao}', [NotificacaoController::class, 'edit'])->name('notificacao.edit');
    Route::put('/update-notificacao/{notificacao}', [NotificacaoController::class, 'update'])->name('notificacao.update');
    Route::delete('/destroy-notificacao/{notificacao}', [NotificacaoController::class, 'destroy'])->name('notificacao.destroy');

    // PAPÉIS
    Route::get('/index-role', [RoleController::class, 'index'])->name('role.index');
    Route::get('/create-role', [RoleController::class, 'create'])->name('role.create');
    Route::post('/store-role', [RoleController::class, 'store'])->name('role.store');
    Route::get('/edit-role/{role}', [RoleController::class, 'edit'])->name('role.edit');
    Route::put('/update-role/{role}', [RoleController::class, 'update'])->name('role.update');
    Route::delete('/destroy-role/{role}', [RoleController::class, 'destroy'])->name('role.destroy');

    //SOBRE
    Route::get('/sobre', [SobreController::class, 'index'])->name('sobre.index');
    
    // PERMISSÃO DO PAPEL
    Route::get('/index-role-permission/{role}', [RolePermissionController::class, 'index'])->name('role-permission.index');
    Route::get('/update-role-permission/{role}/{permission}', [RolePermissionController::class, 'update'])->name('role-permission.update');

    // PERMISSÕES OU PÁGINAS
    Route::get('/index-permission', [PermissionController::class, 'index'])->name('permission.index');
    Route::get('/show-permission/{permission}', [PermissionController::class, 'show'])->name('permission.show');
    Route::get('/create-permission', [PermissionController::class, 'create'])->name('permission.create');
    Route::post('/store-permission', [PermissionController::class, 'store'])->name('permission.store');
    Route::get('/edit-permission/{permission}', [PermissionController::class, 'edit'])->name('permission.edit');
    Route::put('/update-permission/{permission}', [PermissionController::class, 'update'])->name('permission.update');
    Route::delete('/destroy-permission/{permission}', [PermissionController::class, 'destroy'])->name('permission.destroy');

});
