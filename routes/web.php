<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {return view('welcome');});
Route::group(['prefix' => 'reporte'], function () {
    Route::get('/ventas', 'ReporteController@ventas')->name('reporte.ventas');
});
