<?php

namespace App\Api\Product\Requests;

use Support\TableName;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:200',
            'price' => 'required|numeric|gt:0',
	        "tagsId" => "nullable|array",
	        "tagsId.*" => [
		        "numeric",
		        // TODO: fix this
		        // Rule::exists(TableName::tag)
	        ],
	        "categoriesId" => "nullable|array",
	        "categoriesId.*" => [
		        "numeric",
		        // Rule::exists(TableName::category)
	        ],
        ];
    }
	
	public function allowedInputsForStoreProduct(): array
	{
		return $this->only(["title", "price"]);
	}
	
	public function allowedInputsForAttachTags(): array
	{
		return $this->tagsId;
	}
	
	public function allowedInputsForAttachCategories(): array
	{
		return $this->categoriesId;
	}
}
