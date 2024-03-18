<?php

use App\Events\ProductUpdateEvent;
use App\Http\Controllers\ProductController;
use App\Http\Resources\ProductResource;
use App\Imports\ProductImport;
use App\Jobs\ProcessProductTransaction;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('products', [ProductController::class, 'index']);
Route::post('products', [ProductController::class, 'store']);
