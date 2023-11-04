<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Login\LoginController;
use App\Http\Controllers\AdministradorController;
use App\Http\Controllers\PostController;

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


Route::post('/SignIn', [LoginController::class, 'SignIn'])->name('SignIn');
Route::post('/Signup', [LoginController::class, 'Signup'])->name('Signup');

Route::get('/', function () {

    if (Auth::check()) {
        return view('welcome');
    }

    return view('login');
});


Route::prefix('administrador')->group(function () {
    Route::get('/obtener', [AdministradorController::class, 'obtener'])->name('obtener');
    Route::get('/donantes', [AdministradorController::class, 'donantes'])->name('donantes');
    Route::post('/registro', [AdministradorController::class, 'registro'])->name('registro');
    Route::get('/obtenerId_donantes/{id_donantes}', [AdministradorController::class, 'obtenerId_donantes'])->name('obtenerId_donantes');
    Route::put('/actualizar/{id_donantes}', [AdministradorController::class, 'actualizar'])->name('actualizar');
    Route::put('/eliminar/{id_donantes}', [AdministradorController::class, 'eliminar'])->name('eliminar');

    //rutas para beneficiarios
    Route::get('/beneficiarios', [AdministradorController::class, 'beneficiarios'])->name('beneficiarios');
    Route::post('/registroBeneficiado', [AdministradorController::class, 'registroBeneficiado'])->name('registroBeneficiado');
    Route::get('/obtenerBeneficiario', [AdministradorController::class, 'obtenerBeneficiario'])->name('obtenerBeneficiario');
    Route::get('/obtenerId_beneficiados/{id_beneficiados}', [AdministradorController::class, 'obtenerId_beneficiados'])->name('obtenerId_beneficiados');
    Route::put('/actualizarBeneficiarios/{id_beneficiados}', [AdministradorController::class, 'actualizarBeneficiarios'])->name('actualizarBeneficiarios');
    Route::put('/eliminarBeneficiario/{id_beneficiados}', [AdministradorController::class, 'eliminarBeneficiario'])->name('eliminarBeneficiario');
    Route::get('/asignar_beneficiados', [AdministradorController::class, 'asignar_beneficiados'])->name('asignar_beneficiados');
    Route::post('/asignacion_beneficiarios', [AdministradorController::class, 'asignacion_beneficiarios'])->name('asignacion_beneficiarios');
    
    //Reporte de beneficiados
    Route::get('/reporte_asignaciones_bene', [AdministradorController::class, 'reporte_asignaciones_bene'])->name('reporte_asignaciones_bene');
    Route::get('/descargar_pdf_factura', [AdministradorController::class, 'descargar_pdf_factura'])->name('descargar_pdf_factura');
    

    //Creación de post
    Route::get('/post', [AdministradorController::class, 'post'])->name('post');
    Route::post('/post_crear', [AdministradorController::class, 'post_crear'])->name('post_crear');
    Route::post('/eliminar_post', [AdministradorController::class, 'eliminar_post'])->name('eliminar_post');

    //Donaciones
    Route::get('/donaciones', [AdministradorController::class, 'donaciones'])->name('donaciones');

});

Route::prefix('post')->group(function(){
    Route::get('/publicaciones', [PostController::class, 'publicaciones'])->name('publicaciones');
});

