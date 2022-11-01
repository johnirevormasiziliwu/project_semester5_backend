<?php

use App\Http\Controllers\Api\NoteController;
use App\Http\controllers\Api\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\AuthPBEMiddleware;
use Illuminate\Support\Facades\Route;



//Route untuk table Products

Route::post('/auth', [AuthController::class, 'verify']);

//Route untuk coba transaksi
Route::get('/test',[AuthController::class, 'cobaDBTransaksi']);

Route::middleware([AuthPBEMiddleware::class])->group(function () {
   
   Route::get('/products', [ProductController::class,'index']);
   Route::post('/products',[ProductController::class,'store']);
   Route::get('/products/{productId}',[ProductController::class,'getById']);
   Route::put('/products/{productId}',[ProductController::class,'update']);
   Route::delete('/products/{productId}',[ProductController::class,'delete']);
   Route::delete('/products/{productId}/soft-delete',[ProductController::class,'softDelete']);
   Route::put('/products/{productId}/restore',[ProductController::class,'restore']);


   
   //Route untuk table Notes
   
   Route::get('/notes',[NoteController::class, 'index']);
   Route::post('/notes', [NoteController::class, 'store']);
   Route::get('/notes/{noteId}', [NoteController::class, 'getById']);
   Route::put('/notes/{noteId}', [NoteController::class, 'update']);
   Route::delete('/note/{noteId}', [NoteController::class, 'delete']);
   
});