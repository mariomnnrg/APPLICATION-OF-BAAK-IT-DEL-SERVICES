<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReqSuratController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ReqIkController;
use App\Http\Controllers\RoomRequestController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ReqIbController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\KaosController;


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

//Routes Auth
Route::post('login', [UsersController::class, 'login']);
Route::post('register', [UsersController::class, 'register']);


// User CRUD routes
Route::post('users', [UsersController::class, 'create']);
Route::get('users', [UsersController::class, 'index']);
Route::delete('users/{user}', [UsersController::class, 'delete']);

//reqsrat
Route::get('/req-surat', [ReqSuratController::class, 'index']);
Route::post('/req-surat', [ReqSuratController::class, 'store']);
Route::post('/req-surat/{id}/approve', [ReqSuratController::class, 'approve']);
Route::delete('/req-surat/{id}', [ReqSuratController::class, 'delete']);


//reqik
Route::get('/req-ik', [ReqIkController::class, 'index']);
Route::post('/req-ik', [ReqIkController::class, 'store']);
Route::post('/req-ik/{id}/approve', [ReqIkController::class, 'approve']);
Route::delete('/req-ik/{id}', [ReqIkController::class, 'delete']);





//reqib
Route::get('/req-ib', [ReqIbController::class, 'index']);
Route::post('/req-ib', [ReqIbController::class, 'store']);
Route::post('/req-ib/{id}/approve', [ReqIbController::class, 'approve']);
Route::delete('/req-ib/{id}', [ReqIbController::class, 'delete']);


// Routes for RoomRequestController

Route::get('/room-requests', [RoomRequestController::class, 'index']);
Route::post('/room-requests/book', [RoomRequestController::class, 'bookRoom']);
Route::put('/room-requests/approve/{id}', [RoomRequestController::class, 'approveRoomRequest']);
Route::delete('/room-requests/{id}', [RoomRequestController::class, 'rejectRoomRequest']);

// Routes for RoomController
Route::get('/rooms', [RoomController::class, 'index']);
Route::post('/rooms', [RoomController::class, 'create']);
Route::delete('/rooms/{id}', [RoomController::class, 'delete']);


//histori
Route::get('/req-ik/history/{user_id}', [ReqIkController::class, 'getUserHistory']);
Route::get('/req-ib/history/{user_id}', [ReqIbController::class, 'getUserHistory']);
Route::get('/req-surat/history/{user_id}', [ReqSuratController::class, 'getUserHistory']);
Route::get('/room-requests/history/{user_id}', [RoomRequestController::class, 'getUserHistory']);


//route untuk kaos
Route::get('kaos',[KaosController::class,'index']);
Route::get('kaos2',[KaosController::class,'index2']);

Route::post('kaos',[KaosController::class,'store']);

Route::post('/kaos/{kaos}/pembayaran', [PembayaranController::class, 'store']);

?>  
