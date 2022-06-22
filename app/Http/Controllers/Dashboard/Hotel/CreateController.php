<?php

namespace App\Http\Controllers\Dashboard\Hotel;

use App\Models\Hotel;
use App\Helpers\ToastHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class CreateController extends Controller
{
	public function create(Request $request)
	{
		$hotel = new Hotel();
		$hotels = Hotel::where('is_active', true)->get();

		return view('dashboard.hotel.create', compact('hotel', 'hotels'));
	}

	public function store(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'name' => 'required|min:3|max:255',
			'title' => 'required|min:3|max:255',
		], [
			'name.required' => __('validation.name.required'),
			'name.string' => __('validation.name.string'),
			'name.min' => __('validation.name.min'),
			'name.max' => __('validation.name.max'),
			'title.required' => __('validation.title.required'),
			'title.string' => __('validation.title.string'),
			'title.min' => __('validation.title.min', ['min' => 3]),
			'title.max' => __('validation.title.max', ['max' => 255]),
		]);

		if ($validator->fails()) {
			return Redirect::back()->withErrors($validator);
		}
		$hotel = new Hotel();

		$hotel->fill($request->all());

		$hotel->save();

		ToastHelper::success(__('dashboard.content_created_successfully'));

		return redirect()->route('dashboard.hotel.edit', $hotel);
	}
}
