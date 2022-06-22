<?php

namespace App\Http\Controllers\Dashboard\Hotel;

use App\Models\Hotel;
use App\Helpers\ToastHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
	public function edit(Request $request, Hotel $hotel)
	{
		$title = __('dashboard.hotel_edit_title', ['module' => __('dashboard.hotel_tabs.comments')]);
		$description = __('dashboard.hotel_edit_description', ['hotel_name' => $hotel->name]);
		$action = route('dashboard.hotel.comments.edit', [
			'hotel' => $hotel,
		]);

		$comments = $hotel->comments()->paginate(10);

		return view('dashboard.hotel.edit', [
			'title' => $title,
			'description' => $description,
			'action' => $action,
			'module_name' => 'comments',
			'hotel' => $hotel,
			'comments' => $comments,
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

		return redirect()->route('dashboard.hotel.comments.edit', $hotel);
	}
}
