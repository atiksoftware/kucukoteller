<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => 'auth'], function (): void {
	Route::get('/', function () {
		return view('dashboard.home');
	});
});

Route::group(['prefix' => 'dashboard', 'middleware' => 'auth'], function (): void {
	Route::group(['prefix' => 'category'], function (): void {
		Route::get('/', [\App\Http\Controllers\Dashboard\CategoryController::class, 'index'])->name('dashboard.category.index');

		Route::get('/create', [\App\Http\Controllers\Dashboard\CategoryController::class, 'create'])->name('dashboard.category.create');
		Route::post('/store', [\App\Http\Controllers\Dashboard\CategoryController::class, 'store'])->name('dashboard.category.store');
		Route::get('/edit/{category:id}', [\App\Http\Controllers\Dashboard\CategoryController::class, 'edit'])->name('dashboard.category.edit');
		Route::post('/update/{category:id}', [\App\Http\Controllers\Dashboard\CategoryController::class, 'update'])->name('dashboard.category.update');

		Route::get('/remove/{category:id}', [\App\Http\Controllers\Dashboard\CategoryController::class, 'remove'])->scopeBindings()->name('dashboard.category.remove');
		Route::post('/destroy/{category:id}', [\App\Http\Controllers\Dashboard\CategoryController::class, 'destroy'])->scopeBindings()->name('dashboard.category.destroy');
	});

	Route::group(['prefix' => 'zone'], function (): void {
		Route::get('/', [\App\Http\Controllers\Dashboard\ZoneController::class, 'index'])->name('dashboard.zone.index');

		Route::get('/create', [\App\Http\Controllers\Dashboard\ZoneController::class, 'create'])->name('dashboard.zone.create');
		Route::post('/store', [\App\Http\Controllers\Dashboard\ZoneController::class, 'store'])->name('dashboard.zone.store');
		Route::get('/edit/{zone:id}', [\App\Http\Controllers\Dashboard\ZoneController::class, 'edit'])->name('dashboard.zone.edit');
		Route::post('/update/{zone:id}', [\App\Http\Controllers\Dashboard\ZoneController::class, 'update'])->name('dashboard.zone.update');

		Route::get('/remove/{zone:id}', [\App\Http\Controllers\Dashboard\ZoneController::class, 'remove'])->scopeBindings()->name('dashboard.zone.remove');
		Route::post('/destroy/{zone:id}', [\App\Http\Controllers\Dashboard\ZoneController::class, 'destroy'])->scopeBindings()->name('dashboard.zone.destroy');

		Route::group(['prefix' => 'proposal'], function (): void {
			Route::get('/edit/{proposal:id}', [\App\Http\Controllers\Dashboard\ZoneController::class, 'proposal_edit'])->name('dashboard.zone.proposal.edit');
			Route::post('/update/{proposal:id}', [\App\Http\Controllers\Dashboard\ZoneController::class, 'proposal_update'])->name('dashboard.zone.proposal.update');
		});
		Route::group(['prefix' => 'faq'], function (): void {
			Route::get('/edit/{zone:id}', [\App\Http\Controllers\Dashboard\ZoneController::class, 'faq_edit'])->name('dashboard.zone.faq.edit');
			Route::post('/update/{zone:id}', [\App\Http\Controllers\Dashboard\ZoneController::class, 'faq_update'])->name('dashboard.zone.faq.update');
		});
	});

	Route::group(['prefix' => 'hotel'], function (): void {
		Route::get('/', [\App\Http\Controllers\Dashboard\HotelController::class, 'index'])->name('dashboard.hotel.index');

		Route::get('/create', [\App\Http\Controllers\Dashboard\Hotel\CreateController::class, 'create'])->name('dashboard.hotel.create');
		Route::post('/store', [\App\Http\Controllers\Dashboard\Hotel\CreateController::class, 'store'])->name('dashboard.hotel.store');

		Route::get('/edit/{hotel:id}', [\App\Http\Controllers\Dashboard\Hotel\InformationsController::class, 'edit'])->name('dashboard.hotel.edit');
		Route::get('/edit/{hotel:id}/informations', [\App\Http\Controllers\Dashboard\Hotel\InformationsController::class, 'edit'])->name('dashboard.hotel.informations.edit');
		Route::post('/edit/{hotel:id}/informations', [\App\Http\Controllers\Dashboard\Hotel\InformationsController::class, 'update'])->name('dashboard.hotel.informations.update');
		Route::get('/edit/{hotel:id}/general', [\App\Http\Controllers\Dashboard\Hotel\GeneralController::class, 'edit'])->name('dashboard.hotel.general.edit');
		Route::post('/edit/{hotel:id}/general', [\App\Http\Controllers\Dashboard\Hotel\GeneralController::class, 'update'])->name('dashboard.hotel.general.update');

		Route::get('/edit/{hotel:id}/rooms', [\App\Http\Controllers\Dashboard\Hotel\RoomsController::class, 'edit'])->name('dashboard.hotel.rooms.edit');
		Route::post('/edit/{hotel:id}/rooms', [\App\Http\Controllers\Dashboard\Hotel\RoomsController::class, 'update'])->name('dashboard.hotel.rooms.update');
		Route::get('/edit/{hotel:id}/rooms/create', [\App\Http\Controllers\Dashboard\Hotel\RoomsController::class, 'create_room'])->name('dashboard.hotel.rooms.create_room');
		Route::post('/edit/{hotel:id}/rooms/store', [\App\Http\Controllers\Dashboard\Hotel\RoomsController::class, 'store_room'])->name('dashboard.hotel.rooms.store_room');
		Route::get('/edit/{hotel:id}/rooms/edit/{room:id}', [\App\Http\Controllers\Dashboard\Hotel\RoomsController::class, 'edit_room'])->name('dashboard.hotel.rooms.edit_room');
		Route::post('/edit/{hotel:id}/rooms/update/{room:id}', [\App\Http\Controllers\Dashboard\Hotel\RoomsController::class, 'update_room'])->name('dashboard.hotel.rooms.update_room');
		Route::get('/edit/{hotel:id}/rooms/remove/{room:id}', [\App\Http\Controllers\Dashboard\Hotel\RoomsController::class, 'remove_room'])->name('dashboard.hotel.rooms.remove_room');
		Route::post('/edit/{hotel:id}/rooms/destroy/{room:id}', [\App\Http\Controllers\Dashboard\Hotel\RoomsController::class, 'destroy_room'])->name('dashboard.hotel.rooms.destroy_room');

		Route::any('/edit/{hotel:id}/comments', [\App\Http\Controllers\Dashboard\Hotel\CommentController::class, 'edit'])->name('dashboard.hotel.comments.edit');
		Route::get('/edit/{hotel:id}/faq', [\App\Http\Controllers\Dashboard\Hotel\FaqController::class, 'edit'])->name('dashboard.hotel.faq.edit');
		Route::post('/edit/{hotel:id}/faq', [\App\Http\Controllers\Dashboard\Hotel\FaqController::class, 'update'])->name('dashboard.hotel.faq.update');

		// Route::get('/edit/{hotel:id}/{module_name}', [\App\Http\Controllers\Dashboard\Hotel\EditController::class, 'edit'])->name('dashboard.hotel.edit.module');
		// Route::post('/update/{hotel:id}', [\App\Http\Controllers\Dashboard\Hotel\EditController::class, 'update'])->name('dashboard.hotel.update');

		Route::get('/remove/{hotel:id}', [\App\Http\Controllers\Dashboard\Hotel\RemoveController::class, 'remove'])->scopeBindings()->name('dashboard.hotel.remove');
		Route::post('/destroy/{hotel:id}', [\App\Http\Controllers\Dashboard\Hotel\RemoveController::class, 'destroy'])->scopeBindings()->name('dashboard.hotel.destroy');

		// Route::get('/edit/{hotel:id}/room/create', [\App\Http\Controllers\Dashboard\Hotel\Room\CreateController::class, 'create'])->name('dashboard.hotel.room.create');
		// Route::post('/edit/{hotel:id}/room/store', [\App\Http\Controllers\Dashboard\Hotel\Room\CreateController::class, 'store'])->name('dashboard.hotel.room.store');
		// Route::get('/edit/{hotel:id}/room/edit/{room:id}', [\App\Http\Controllers\Dashboard\Hotel\Room\EditController::class, 'edit'])->name('dashboard.hotel.room.edit');
		// Route::post('/edit/{hotel:id}/room/update/{room:id}', [\App\Http\Controllers\Dashboard\Hotel\Room\EditController::class, 'update'])->name('dashboard.hotel.room.update');
		// Route::get('/edit/{hotel:id}/room/remove/{room:id}', [\App\Http\Controllers\Dashboard\Hotel\Room\RemoveController::class, 'remove'])->scopeBindings()->name('dashboard.hotel.room.remove');
		// Route::post('/edit/{hotel:id}/rooms/destroy/{room:id}', [\App\Http\Controllers\Dashboard\Hotel\Room\RemoveController::class, 'destroy'])->scopeBindings()->name('dashboard.hotel.room.destroy');
	});
});

require __DIR__ . '/web.auth.php';
