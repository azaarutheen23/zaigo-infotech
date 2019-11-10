<?php

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

// Route::get('/', function () {
//     return view('employee_list');
// });
// Route::get('/register', function () {
//     return view('register');
// });
Route::get('/','EmployeeManagement@list');
Route::get('register','EmployeeManagement@register');
Route::post('insert','EmployeeManagement@insert');
Route::get('delete/{id}','EmployeeManagement@delete');
Route::get('edit/{id}','EmployeeManagement@edit');
Route::post('update','EmployeeManagement@update');
Route::post('chkmail','EmployeeManagement@chkmail');
