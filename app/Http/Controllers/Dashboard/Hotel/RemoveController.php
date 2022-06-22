<?php

namespace App\Http\Controllers\Dashboard\Hotel;

use App\Models\Hotel;
use App\Helpers\ToastHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RemoveController extends Controller
{
	public function remove(Request $request, Hotel $hotel)
	{
		$name = $hotel->name;
		$confirm_url = route('dashboard.hotel.destroy', $hotel);
		$cancel_url = route('dashboard.hotel.edit', $hotel);

		return view('dashboard.remove', compact('name', 'confirm_url', 'cancel_url'));
	}

	public function destroy(Request $request, Hotel $hotel)
	{
		$hotel->delete();

		ToastHelper::success(__('dashboard.content_removed_successfully'));

		return redirect()->route('dashboard.hotel.index');
	}
}
