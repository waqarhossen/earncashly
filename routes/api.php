<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\redeem_requests;
use App\Http\Controllers\Postback\OfferController;


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

/*Route::get('adget', 'Postback\OfferController@adget')->name('adget.offer');
Route::get('adgem', 'Postback\OfferController@adgem')->name('adgem.offer');
Route::get('offertoro', 'Postback\OfferController@offertoro')->name('offertoro.offer');
Route::get('ayet', 'Postback\OfferController@ayet')->name('ayet.offer');
Route::get('cpalead', 'Postback\OfferController@clead')->name('clead.offer');
Route::get('bitlab', 'Postback\OfferController@bitlab')->name('bitlab.offer');
Route::get('cpxr', 'Postback\OfferController@cpxr')->name('cpxr.offer');
Route::get('inbrain', 'Postback\OfferController@inbrain')->name('inbrain.offer');
Route::get('mmwall', 'Postback\OfferController@mmwall')->name('mmwall.offer');
Route::get('wannads', 'Postback\OfferController@wannads')->name('wannads.offer');*/

//s2s APIs
Route::get('inbrain', [OfferController::class, 'inBrain']);
Route::get('adgem', [OfferController::class, 'adgem']);
Route::get('tapjoy', [OfferController::class, 'tapjoy']);
Route::get('pollfish', [OfferController::class, 'pollfish']);
Route::get('cpalead', [OfferController::class, 'cpalead']);
Route::get('offertoro', [OfferController::class, 'offertoro']);
Route::get('adget', [OfferController::class, 'adget']);
Route::get('ayet', [OfferController::class, 'ayet']);
Route::get('mmwall', [OfferController::class, 'mm']);
// Route::get('adgApi', [UserController::class, 'adgApi']); // TODO: UserController needs to be created
Route::get('monli', [OfferController::class, 'monli']);
Route::get('cpxr', [OfferController::class, 'cpxr']);
Route::get('bitlab', [OfferController::class, 'bitlab']);
Route::get('wann', [OfferController::class, 'wann']);
Route::get('revlum', [OfferController::class, 'Revlum']);
Route::get('lootably', [OfferController::class, 'lootably']);
Route::get('notik', [OfferController::class, 'notik']);
Route::get('admantum', [OfferController::class, 'admantum']);
Route::get('Adscend', [OfferController::class, 'Adscend']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
