<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
	public function index(Request $request)
	{
		$records = [];

		$search = $request->input('search');

		// if (null !== $search) {
		// 	$records = Category::where('type_id', 2)->where('name', 'like', '%' . $search . '%')
		// 		->orderBy('name', 'ASC')
		// 		->paginate(50);
		// } else {
		$records = Category::where('is_active', true)
			->paginate(50);
		// }

		return view('dashboard.categories', [
			'records' => $records,
		]);
	}
}
