<?php

namespace App\Api\Product\Resources;

use Illuminate\Http\Request;
use Domain\Product\Models\Product;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductCollection extends ResourceCollection
{
    public function toArray(Request $request): array
    {
        return $this->collection->transform(function (Product $product) {
			return [
				"id" => $product->id,
				"title" => $product->title,
				"price" => $product->price
			];
        });
    }
}
