<?php

namespace Tests\Unit\Product;

use Mockery;
use Exception;
use Tests\TestCase;
use Mockery\MockInterface;
use Domain\Product\Models\Product;
use Illuminate\Support\Facades\Event;
use App\Api\Product\Resources\ProductResource;
use App\Api\Product\Actions\StoreProductAction;
use App\Api\Product\Requests\StoreProductRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Domain\Product\DataTransferObjects\StoreProductDto;
use Domain\Product\Abstracts\StoreProductServiceInterface;
use Domain\Product\DataTransferObjects\AttachTagsToProductDto;
use Domain\Product\Abstracts\AttachTagsToProductServiceInterface;
use Domain\Product\DataTransferObjects\AttachProductToCategoriesDto;
use Domain\Product\Abstracts\AttachProductToCategoriesServiceInterface;

class StoreProductActionTest extends TestCase
{
	use RefreshDatabase;
	
	private StoreProductAction $action;
	private MockInterface $storeProductServiceMock;
	private MockInterface $attachProductToCategoriesServiceMock;
	private MockInterface $attachTagsToProductServiceMock;
	private StoreProductRequest $request;
	
	protected function setUp(): void
	{
		parent::setUp();
		
		$this->storeProductServiceMock = Mockery::mock(
			StoreProductServiceInterface::class
		);
		
		$this->attachProductToCategoriesServiceMock = Mockery::mock(
			AttachProductToCategoriesServiceInterface::class
		);
		
		$this->attachTagsToProductServiceMock = Mockery::mock(
			AttachTagsToProductServiceInterface::class
		);
		
		$this->createRequest();
		
		Event::fake();
		
		$this->action = new StoreProductAction(
			$this->storeProductServiceMock,
			$this->attachProductToCategoriesServiceMock,
			$this->attachTagsToProductServiceMock
		);
	}
	
	/** @test */
	public function testStoreSuccessful(): void
	{
		$this->storeProductServiceMock->shouldReceive('execute')
			->with(Mockery::type(StoreProductDto::class))
			->andReturn(serviceResponse()->setData($this->getExpectedProduct()));
		
		$this->attachProductToCategoriesServiceMock->shouldReceive('execute')
			->with(Mockery::type(AttachProductToCategoriesDto::class))
			->andReturn(serviceResponse());
		
		$this->attachTagsToProductServiceMock->shouldReceive('execute')
			->with(Mockery::type(AttachTagsToProductDto::class))
			->andReturn(serviceResponse());
		
		$response = $this->action->store($this->request);
		
		$expected = serviceResponse()
			->setData($this->getExpectedProduct())
			->getApiResponseCollection(ProductResource::class)
			->getData();
		
		$this->assertEquals(
			$expected,
			$response->getData(),
		);
	}
	
	/** @test */
	public function testStoreFailure(): void
	{
		$this->storeProductServiceMock->shouldReceive('execute')
			->with(Mockery::type(StoreProductDto::class))
			->andReturn(serviceResponse()->setData($this->getExpectedProduct()));
		
		$this->attachProductToCategoriesServiceMock->shouldReceive('execute')
			->with(Mockery::type(AttachProductToCategoriesDto::class))
			->andThrow(new Exception("attach categories failed"));
		
		$this->attachTagsToProductServiceMock->shouldReceive('execute')
			->with(Mockery::type(AttachTagsToProductDto::class))
			->andThrow(new Exception("attach categories failed"));
		
		$response = $this->action->store($this->request);
		
		$expected = serviceResponse()
			->setStatus(404)
			->setMessage(__("failed to store the product"))
			->getApiResponse()
			->getData();
		
		$this->assertEquals($expected, $response->getData());
	}
	
	private function createRequest(): void
	{
		$this->request = Mockery::mock(StoreProductRequest::class);
		
		$this->request->shouldReceive('allowedInputsForStoreProduct')
			->andReturn($this->getProductData());
		
		$this->request->shouldReceive('allowedInputsForAttachCategories')
			->andReturn($this->getCategoriesData());
		
		$this->request->shouldReceive('allowedInputsForAttachTags')
			->andReturn($this->getTagsData());
	}
	
	private function getProductData(): array
	{
		return ['title' => 'Product 1', 'price' => 10.99];
	}
	
	private function getCategoriesData(): array
	{
		return [1, 2];
	}
	
	private function getTagsData(): array
	{
		return [1, 2];
	}
	
	private function getExpectedProduct(): Product
	{
		return new Product(array_merge(["id" => 1], $this->getProductData()));
	}
	
	protected function tearDown(): void
	{
		parent::tearDown();
		
		Event::fake(false);
		Mockery::close();
	}
}
