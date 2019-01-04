<?php

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

Route::catch(function () {
    throw new NotFoundHttpException;
});

Route::get('/home', 'Dashboard@index')->name('admin_dashboard');

Route::get('/alumnos', 'Dashboard@buscarAlumno')->name('buscar.alumno');
Route::post('/buscar/alumno', 'Dashboard@buscarAlumnoPost')->name('buscar.alumnoPost');
// Route::get('/editar/alumno/{num_cta}', 'Dashboard@editarAlumno')
//    ->where('num_cta','[0-9]+')
//    ->name('editar.alumno');
Route::post('/editar/alumno', 'Dashboard@editarAlumnoSave')
   ->where('num_cta','[0-9]+')
   ->name('editar.alumnoSave');

Route::get('/promedios', 'UpdateController@promedios')->name('promedios.historico');
Route::get('/calcula-turno', 'UpdateController@calculaTurno')->name('calcula.turno');
Route::get('/asignar-fechas', 'UpdateController@asignarFechas')->name('calcula.fechas');

Route::any('/import-alumnos', 'ImportController@alumnosImport')->name('carga.alumnos');
Route::any('/import-historias-academicas', 'ImportController@HistoriasAcademicasImport')->name('carga.historias');
