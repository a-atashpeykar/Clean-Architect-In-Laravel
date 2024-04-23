<?php

namespace Domain\Product\Observers;

use Domain\Product\Models\Product;

class ProductObserver
{
	public function creating(Product $product): void
	{
		if (config("env") === "production") {
			$product->created_by = auth()->id();
		} else {
			$product->created_by = 1;
		}
    }
	
	public function updating(Product $product): void
	{
		$product->updated_by = auth()->id();
	}
}
