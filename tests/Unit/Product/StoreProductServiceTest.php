<?php

namespace Product;

use Mockery;
use Tests\TestCase;
use Mockery\MockInterface;
use Support\ServiceResponse;
use Domain\Product\Models\Product;
use Domain\Product\Services\StoreProductService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Domain\Product\DataTransferObjects\StoreProductDto;
use Domain\Product\Abstracts\ProductRepositoryInterface;

class StoreProductServiceTest extends TestCase
{
	use RefreshDatabase;
	
	private MockInterface $mockProductRepository;

	private StoreProductService $storeProductService;
	
	protected function setUp(): void
	{
		parent::setUp();
		
		$this->mockProductRepository = Mockery::mock(ProductRepositoryInterface::class);
		$this->storeProductService = new StoreProductService($this->mockProductRepository);
	}
	
	protected function tearDown(): void
	{
		parent::tearDown();
		
		Mockery::close();
	}
	
	/** @test */
	public function test_execute_stores_product_successfully()
	{
		$storeProductDto = StoreProductDto::fromArray([
			'title' => 'Product Title',
			'price' => 9.99,
		]);
		$expectedProduct = new Product(["id" => 1, "title" => "test", "price" => 9.99]);
		
		$this->mockProductRepository
			->shouldReceive('store')
			->with($storeProductDto)
			->andReturn($expectedProduct);
		
		$response = $this->storeProductService->execute($storeProductDto);
		
		$this->assertInstanceOf(ServiceResponse::class, $response);
		$this->assertTrue($response->isSuccessful());
		$this->assertEquals(201, $response->getStatusCode());
		$this->assertEquals($expectedProduct, $response->getData());
	}
	
	/** @test */
	public function test_execute_stores_product_failure()
	{
		$storeProductDto = StoreProductDto::fromArray([
			'title' => 'Product Title',
			'price' => 9.99,
		]);
		$expectedProduct = new Product(["id" => 1, "title" => "test", "price" => 9.99]);
		
		$this->mockProductRepository
			->shouldReceive('store')
			->with($storeProductDto)
			->andReturn($expectedProduct);
		
		$response = $this->storeProductService->execute($storeProductDto);
		
		$this->assertInstanceOf(ServiceResponse::class, $response);
		$this->assertTrue($response->isSuccessful());
		$this->assertEquals(201, $response->getStatusCode());
		$this->assertEquals($expectedProduct, $response->getData());
	}
	
	public function testExecuteFailsToStoreProduct()
	{
		$storeProductDto = StoreProductDto::fromArray([
			'title' => 'Product Title',
			'price' => 9.99,
		]);
		
		$this->mockProductRepository
			->shouldReceive('store')
			->with($storeProductDto)
			->once()
			->andReturn(null);
		
		$response = $this->storeProductService->execute($storeProductDto);
		
		$this->assertInstanceOf(ServiceResponse::class, $response);
		$this->assertTrue($response->isFailed());
		$this->assertNull($response->getData());
	}
}
