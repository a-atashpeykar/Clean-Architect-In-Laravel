<?php

namespace Domain\Category\Observers;

use Domain\Category\Models\Category;

class CategoryObserver
{
	public function creating(Category $category): void
	{
		$category->created_by = auth()->id();
    }
	
	public function updating(Category $category): void
	{
		$category->updated_by = auth()->id();
	}
}
