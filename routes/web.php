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

Route::get('/', function () {
    return view('index');
});
Route::get('alumnos/{alumno}/fmatricula', 'AlumnoController@fmatricula')->name('alumnos.fmatricula');
Route::get('alumnos/{alumno}/fcalificar', 'AlumnoController@fcalificar')->name('alumnos.fcalificar');
//Cargamos losresurces
Route::resource('alumnos', 'AlumnoController');
Route::resource('modulos', 'ModuloController');
//Los post debajo de los resources
Route::post('alumnosM', 'AlumnoController@matricular')->name('alumnos.matricular');
Route::post('alumnosC', 'AlumnoController@calificar')->name('alumnos.calificar');
