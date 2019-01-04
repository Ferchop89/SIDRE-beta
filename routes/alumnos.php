<?php


use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

Route::catch(function () {
    throw new NotFoundHttpException;
});

Route::get('/', 'Dashboard@index')->name('alumno_dashboard');
