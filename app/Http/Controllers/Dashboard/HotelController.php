<?php

namespace App\Http\Controllers\Dashboard;

use App\Constants\DashboardHotelTabs;
use App\Models\Hotel;
use App\Helpers\ToastHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class HotelController extends Controller
{
	public function index(Request $request)
	{
		$hotels = [];

		$search = $request->input('search');

		if (null !== $search) {
			$hotels = Hotel::where('title', 'like', '%' . $search . '%')
				// ->orderBy('title', 'ASC')
				->paginate(50);
		} else {
			$hotels = Hotel::where('is_active', true)
				->paginate(12);
		}

		return view('dashboard.hotel.list', compact('hotels'));
	}

	// public function create(Request $request)
	// {
	// 	$hotel = new Hotel();
	// 	$hotels = Hotel::where('is_active', true)->get();

	// 	return view('dashboard.hotel.create', compact('hotel', 'hotels'));
	// }

	// public function store(Request $request)
	// {
	// 	$validator = Validator::make($request->all(), [
	// 		'name' => 'required|min:3|max:255',
	// 		'title' => 'required|min:3|max:255',
	// 	], [
	// 		'name.required' => __('validation.name.required'),
	// 		'name.string' => __('validation.name.string'),
	// 		'name.min' => __('validation.name.min'),
	// 		'name.max' => __('validation.name.max'),
	// 		'title.required' => __('validation.title.required'),
	// 		'title.string' => __('validation.title.string'),
	// 		'title.min' => __('validation.title.min', ['min' => 3]),
	// 		'title.max' => __('validation.title.max', ['max' => 255]),
	// 	]);

	// 	if ($validator->fails()) {
	// 		return Redirect::back()->withErrors($validator);
	// 	}
	// 	$hotel = new Hotel();

	// 	$hotel->fill($request->all());

	// 	$hotel->save();

	// 	ToastHelper::success(__('dashboard.content_created_successfully'));

	// 	return redirect()->route('dashboard.hotel.edit', $hotel);
	// }

	// public function edit(Request $request, Hotel $hotel, $module_name = null)
	// {
	// 	$hotels = Hotel::where('is_active', true)->get();
	// 	if (null === $module_name || !\in_array($module_name, DashboardHotelTabs::keys(), true)) {
	// 		$module_name = DashboardHotelTabs::keys()[0];
	// 	}

	// 	return view('dashboard.hotel.edit', compact('hotel', 'hotels', 'module_name'));
	// }

	// public function update(Request $request, Hotel $hotel)
	// {
	// 	$request->validate([
	// 		'title' => 'required|string|max:255',
	// 	], [
	// 		'title.required' => __('validation.title.required'),
	// 		'title.max' => __('validation.title.max', ['max' => 255]),
	// 	]);

	// 	$hotel->fill($request->all());

	// 	$hotel->save();

	// 	ToastHelper::success(__('dashboard.content_updated_successfully'));

	// 	return redirect()->route('dashboard.hotel.edit', $hotel);
	// }

	// public function remove(Request $request, Hotel $hotel)
	// {
	// 	$name = $hotel->name;
	// 	$confirm_url = route('dashboard.hotel.destroy', $hotel);
	// 	$cancel_url = route('dashboard.hotel.edit', $hotel);

	// 	return view('dashboard.remove', compact('name', 'confirm_url', 'cancel_url'));
	// }

	// public function destroy(Request $request, Hotel $hotel)
	// {
	// 	$hotel->delete();

	// 	ToastHelper::success(__('dashboard.content_removed_successfully'));

	// 	return redirect()->route('dashboard.hotel.index');
	// }
}
