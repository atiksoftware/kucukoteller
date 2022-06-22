<?php

namespace App\Http\Controllers\Dashboard\Hotel;

use App\Models\Hotel;
use App\Helpers\ToastHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GeneralController extends Controller
{
	public function edit(Request $request, Hotel $hotel)
	{
		$title = __('dashboard.hotel_edit_title', ['module' => __('dashboard.hotel_tabs.general')]);
		$description = __('dashboard.hotel_edit_description', ['hotel_name' => $hotel->name]);
		$action = route('dashboard.hotel.general.update', [
			'hotel' => $hotel,
		]);

		return view('dashboard.hotel.edit', [
			'title' => $title,
			'description' => $description,
			'action' => $action,
			'module_name' => 'general',
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

		return redirect()->route('dashboard.hotel.general.edit', $hotel);
	}
}
