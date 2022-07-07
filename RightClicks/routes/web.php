<?php
use App\Http\Controllers\Admin;
use App\Http\Controllers\CustomAuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('login', [CustomAuthController::class, 'index'])->name('login');
Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom');
Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');


Route::middleware(['auth'])->group(function () {
    Route::get('/', function(){ return redirect('dashboard'); });
    Route::get('/dashboard', [CustomAuthController::class, 'dashboard'])->name('dashboard');
    Route::get('/register/user', [Admin::class, 'registration'])->name('registeruser');
    Route::post('/add/user',[Admin::class, 'addNewUser'])->name('addNewUser');
    Route::get('/list/users', [Admin::class, 'listUsers'])->name('listusers');
    Route::post('/user/edit', [Admin::class, 'editUser'])->name('edituser');
    Route::get('/user/delete/{id}', [Admin::class, 'deleteUser'])->name('deleteuser');

    Route::get('/list/departments', [Admin::class, 'listDepartment'])->name('listDepartment');
    Route::post('/add/department',[Admin::class, 'addDepartment'])->name('addDepartment');
    Route::post('/department/edit', [Admin::class, 'editDepartment'])->name('editDepartment');
    Route::get('/department/delete/{id}', [Admin::class, 'deleteDepartment'])->name('deleteDepartment');

    Route::get('/list/tasks', [Admin::class, 'listTask'])->name('listTask');
    Route::post('/add/task',[Admin::class, 'addTask'])->name('addTask');
    Route::post('/task/edit', [Admin::class, 'editTask'])->name('editTask');
    Route::get('/task/delete/{id}', [Admin::class, 'deleteTask'])->name('deleteTask');

    Route::get('/assign/task', [Admin::class, 'assignTask'])->name('assigntask');
    Route::post('/assign/task/check', [Admin::class, 'check'])->name('check');
    Route::post('/assign/task/set', [Admin::class, 'setAssignTask'])->name('setassigntask');
    Route::get('/pending/task', [Admin::class, 'pendingTask'])->name('pendingtask');

    Route::get('/account/user', [Admin::class, 'accountUser'])->name('accountuser');
    Route::post('/account/edit', [Admin::class, 'editAccount'])->name('accountedit');
    Route::get('/user/task', [Admin::class, 'userTask'])->name('usertask');
    Route::get('/task/completed/{id}', [Admin::class, 'taskCompleted'])->name('taskcompleted');
});
