<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
//use App\Models\Pub;//modelo para hacer uso de la tabla en db

use App\Http\Controllers\PubController;//importar un controlador

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


/*DB::listen(function ($query){
	dump($query->sql);
});*/
//!muestra consultas sql


//!----------------------------[ Retornar una vista GET ]-------------------------------------
/*Route::get('/', function () {
    return view('welcome');
});*/

//!----------------------------[ Retornar una vista GET simplificada con nombre ]-------------------------------------
Route::view('/','welcome')->name('welcome');

//!-----------------------------[ Rutas ]-------------------------------------------
/*Route::get('/pubs', function () {
    return 'Aquí estan las publicaciones';
});*/

//!-------------------------------[ Rutas con parametros ]----------------------------------------
/*Route::get('/pubs/{id}', function ($id) {
    return 'Publicación: ';
});*/

//!-------------------------------[ Rutas con parametros opcionales ]----------------------------------------
/*Route::get('/pubs/{id?}', function ($id=null) {
	if($id==null) return 'Aquí estan las publicaciones';
    return 'Publicación: '.$id;
});*/

//!-------------------------------[ Rutas con nombre ]----------------------------------------
/*Route::get('/pubs/{id?}', function ($id=null) {
	if($id==null) return 'Aquí estan las publicaciones';
    return 'Publicación: '.$id;
})->name('pubs.index');*/

//!-------------------------------[ Rutas con redirección ]----------------------------------------
/*Route::get('/redirect', function ($id=null) {
    return redirect('/pubs');
});*/

//!-------------------------------[ Rutas con redirección a nombre ]----------------------------------------
/*Route::get('/redirect', function ($id=null) {
    return redirect()->route('pubs.index');
});*/

//!-------------------------------[ Rutas con redirección a nombre simplificada ]----------------------------------------
/*Route::get('/redirect', function ($id=null) {
    return to_route('pubs.index');
});*/


/**
 * !middleware se ejecuta antes o despues del return
 * ?En este ejemplo se ejecutas dos middleware [ 'auth', 'verified' ]
 */
/*Route::get('/dashboard', function () {
	// * Codigo middleware
	// * 'auth' if logged in
	// * else redirect to login
	// * verified se tiene que activar en /app/Models/User.php verifica que el correo esta validado
    return view('dashboard');
	// * Codigo middleware
//})->middleware(['auth', 'verified'])->name('dashboard'); //como no se usa veridied
})->middleware('auth')->name('dashboard');*/

Route::middleware('auth')->group(function () {

	//!agregamos la ruta dentro del grupo
	Route::view('/dashboard','dashboard')->name('dashboard');

	//!editar controladores /app/Http/Controllers/[controller].php
	//?[Controller::class,'Metodo']
	Route::get('/pubs', [PubController::class,'index'])->name('pubs.index');
	Route::post('/pubs',[PubController::class,'store'])->name('pubs.store');
	Route::get('/pubs/{pub}/edit',[PubController::class,'edit'])->name('pubs.edit');
	Route::put('/pubs/{pub}',[PubController::class,'update'])->name('pubs.update');
	Route::delete('/pubs/{pub}',[PubController::class,'destroy'])->name('pubs.destroy');



    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php'; //mas middleware
