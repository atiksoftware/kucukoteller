<?php

namespace App\Http\Controllers\Dashboard\Hotel;

use App\Models\Hotel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FaqController extends Controller
{
	public function edit(Request $request, Hotel $hotel)
	{
		$title = __('dashboard.hotel_edit_title', ['module' => __('dashboard.hotel_tabs.faq')]);
		$description = __('dashboard.hotel_edit_description', ['hotel_name' => $hotel->name]);
		$action = route('dashboard.hotel.faq.edit', [
			'hotel' => $hotel,
		]);

		$faqs = $hotel->faqs()->paginate(10);

		return view('dashboard.hotel.edit', [
			'title' => $title,
			'description' => $description,
			'action' => $action,
			'module_name' => 'faq',
			'hotel' => $hotel,
			'faqs' => $faqs,
		]);
	}

	public function update(Request $request, Hotel $hotel): void
	{
	}
}
