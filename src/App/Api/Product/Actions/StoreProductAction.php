<?php

namespace App\Api\Product\Actions;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Domain\Product\Events\ProductCreated;
use App\Api\Product\Resources\ProductResource;
use App\Api\Product\Requests\StoreProductRequest;
use Domain\Product\DataTransferObjects\StoreProductDto;
use Domain\Product\Abstracts\StoreProductServiceInterface;
use Domain\Product\DataTransferObjects\AttachTagsToProductDto;
use Domain\Product\Abstracts\AttachTagsToProductServiceInterface;
use Domain\Product\DataTransferObjects\AttachProductToCategoriesDto;
use Domain\Product\Abstracts\AttachProductToCategoriesServiceInterface;

/**
 * @OA\Post(
 *     path="/api/v1/products",
 *     summary="Store a new product",
 *     tags={"Products"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"title", "price"},
 *             @OA\Property(property="title", type="string", example="Product Title"),
 *             @OA\Property(property="price", type="number", format="float", example=9.99),
 *             @OA\Property(property="tagsId", type="array", @OA\Items(type="integer"), example={1, 2}),
 *             @OA\Property(property="categoriesId", type="array", @OA\Items(type="integer"), example={3, 4})
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Successful response",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="data", type="object", ref="#/components/schemas/ProductResource")
 *         )
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Validation error",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="The given data was invalid."),
 *             @OA\Property(property="errors", type="object")
 *         )
 *     )
 * )
 */
class StoreProductAction
{
	public function __construct(
		private readonly StoreProductServiceInterface              $storeProductService,
		private readonly AttachProductToCategoriesServiceInterface $attachProductToCategoriesService,
		private readonly AttachTagsToProductServiceInterface       $attachTagsToProductService,
	) {}

	public function store(StoreProductRequest $request): JsonResponse
	{
		try {
			DB::beginTransaction();

			$storeProductServiceResponse = $this->storeProductService->execute(
				StoreProductDto::fromArray(
					$request->allowedInputsForStoreProduct()
				)
			);

			if ($storeProductServiceResponse->isFailed()) {
				return $storeProductServiceResponse->getApiResponse();
			}

			$attachCategoriesResponse = $this->attachProductToCategoriesService->execute(
				AttachProductToCategoriesDto::fromArray([
					"categoriesId" => $request->allowedInputsForAttachCategories(),
					"product" => $storeProductServiceResponse->getData(),
				])
			);

			if ($attachCategoriesResponse->isFailed()) {
				return $storeProductServiceResponse->getApiResponse();
			}

			$attachTagsResponse = $this->attachTagsToProductService->execute(
				AttachTagsToProductDto::fromArray([
					"tagsId" => $request->allowedInputsForAttachTags(),
					"product" => $storeProductServiceResponse->getData(),
				])
			);

			if ($attachTagsResponse->isFailed()) {
				return $storeProductServiceResponse->getApiResponse();
			}

			ProductCreated::dispatch($storeProductServiceResponse->getData());

			DB::commit();

			return $storeProductServiceResponse->getApiResponseCollection(
				ProductResource::class
			);
		} catch (Exception $exception) {
			DB::rollBack();

			logger()->error($exception->getMessage());

			return serviceResponse()
				->setStatus(404)
				->setMessage(__("failed to store the product"))
				->getApiResponse();
		}
	}
}
