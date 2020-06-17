<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resources([
    'user' => 'API\UserController',
    'admin' => 'API\AdminController',
    'student' => 'API\StudentController',
    'teacher' => 'API\TeacherController',
    'attendance' => 'API\AttendanceController',
    'calendar' => 'API\CalendarController',
    'module' => 'API\ModuleController',
    'element' => 'API\ElementController',
    'filliere' => 'API\FilliereController',
    'department' => 'API\DepartmentController',
]);

