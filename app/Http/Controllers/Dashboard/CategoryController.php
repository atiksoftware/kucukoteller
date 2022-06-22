<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\ToastHelper;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
	public function index(Request $request)
	{
		$categories = [];

		$search = $request->input('search');

		if (null !== $search) {
			$categories = Category::where('title', 'like', '%' . $search . '%')
				// ->orderBy('title', 'ASC')
				->paginate(50);
		} else {
			$categories = Category::where('is_active', true)
				->paginate(12);
		}

		return view('dashboard.category.list', compact('categories'));
	}

	public function create(Request $request)
	{
		$category = new Category();

		return view('dashboard.category.create', compact('category'));
	}

	public function store(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'title' => 'required|min:3|max:255',
		], [
			'title.required' => __('validation.title.required'),
			'title.min' => __('validation.title.min', ['min' => 3]),
			'title.max' => __('validation.title.max', ['max' => 255]),
		]);

		if ($validator->fails()) {
			return Redirect::back()->withErrors($validator);
		}
		$category = new Category();

		$category->fill($request->all());

		$category->save();

		ToastHelper::success(__('dashboard.content_created_successfully'));

		return redirect()->route('dashboard.category.edit', $category);
	}

	public function edit(Request $request, Category $category)
	{
		return view('dashboard.category.edit', compact('category'));
	}

	public function update(Request $request, Category $category)
	{
		$request->validate([
			'title' => 'required|string|max:255',
		], [
			'title.required' => __('validation.title.required'),
			'title.max' => __('validation.title.max', ['max' => 255]),
		]);

		$category->fill($request->all());

		$category->save();

		ToastHelper::success(__('dashboard.content_updated_successfully'));

		return redirect()->route('dashboard.category.edit', $category);
	}

	public function remove(Request $request, Category $category)
	{
		$name = $category->title;
		$confirm_url = route('dashboard.category.destroy', $category);
		$cancel_url = route('dashboard.category.edit', $category);

		return view('dashboard.remove', compact('name', 'confirm_url', 'cancel_url'));
	}

	public function destroy(Request $request, Category $category)
	{
		$category->delete();

		ToastHelper::success(__('dashboard.content_removed_successfully'));

		return redirect()->route('dashboard.category.index');
	}
}
