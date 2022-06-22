<?php

namespace App\Observers;

use App\Models\Category;
use Illuminate\Support\Str;

class CategoryObserver
{
	public function saving(Category $category): void
	{
		if (empty($category->slug)) {
			$category->meta_title = Str::slug($category->title);
		}
		if (empty($category->meta_title)) {
			$category->meta_title = $category->title;
		}
		if (empty($category->meta_description)) {
			$category->meta_description = $category->brief;
		}
	}
}
