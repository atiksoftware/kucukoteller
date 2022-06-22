<?php

namespace App\Http\Controllers\Dashboard\Hotel;

use App\Models\Hotel;
use App\Helpers\ToastHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BedType;
use App\Models\Room;

class RoomsController extends Controller
{
	public function edit(Request $request, Hotel $hotel)
	{
		$title = __('dashboard.hotel_edit_title', ['module' => __('dashboard.hotel_tabs.rooms')]);
		$description = __('dashboard.hotel_edit_description', ['hotel_name' => $hotel->name]);
		$action = route('dashboard.hotel.rooms.update', [
			'hotel' => $hotel,
		]);

		return view('dashboard.hotel.edit', [
			'title' => $title,
			'description' => $description,
			'action' => $action,
			'module_name' => 'rooms',
			'hotel' => $hotel,
		]);
	}

	public function update(Request $request, Hotel $hotel)
	{
		$request->validate([
			'name' => 'required|string|max:255',
		], [
			'name.required' => __('validation.name.required'),
			'name.max' => __('validation.name.max', ['max' => 255]),
		]);

		$hotel->fill($request->all());

		$hotel->save();

		ToastHelper::success(__('dashboard.content_updated_successfully'));

		return redirect()->route('dashboard.hotel.rooms.edit', $hotel);
	}

	public function create_room(Request $request, Hotel $hotel)
	{
		$title = __('dashboard.rooms_create_title');
		$description = __('dashboard.rooms_create_description', ['hotel_name' => $hotel->name]);
		$action = route('dashboard.hotel.rooms.store_room', $hotel);
		$action_name = __('dashboard.create');

		$room = new Room();
		$bed_types = BedType::all();

		return view('dashboard.hotel.room', [
			'title' => $title,
			'description' => $description,
			'action' => $action,
			'action_name' => $action_name,
			'module_name' => 'rooms',
			'hotel' => $hotel,
			'room' => $room,
			'bed_types' => $bed_types,
		]);
	}

	public function store_room(Request $request, Hotel $hotel): void
	{
	}

	public function edit_room(Request $request, Hotel $hotel, Room $room)
	{
		$title = __('dashboard.rooms_edit_title');
		$description = __('dashboard.rooms_edit_description', ['hotel_name' => $hotel->name, 'room_name' => $room->name]);
		$action = route('dashboard.hotel.rooms.update_room', [
			'hotel' => $hotel,
			'room' => $room,
		]);
		$action_name = __('dashboard.edit');

		$bed_types = BedType::all();

		return view('dashboard.hotel.room', [
			'title' => $title,
			'description' => $description,
			'action' => $action,
			'action_name' => $action_name,
			'module_name' => 'rooms',
			'hotel' => $hotel,
			'room' => $room,
			'bed_types' => $bed_types,
		]);
	}

	public function update_room(Request $request, Hotel $hotel, Room $room): void
	{
	}

	public function remove_room(Request $request, Hotel $hotel, Room $room): void
	{
	}
    
}
