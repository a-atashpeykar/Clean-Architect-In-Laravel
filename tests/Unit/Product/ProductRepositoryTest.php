<?php

namespace Product;

use Mockery;
use Tests\TestCase;
use Mockery\MockInterface;
use Domain\Product\Models\Product;
use Domain\Product\Repositories\ProductRepository;
use Domain\Product\DataTransferObjects\StoreProductDto;

class ProductRepositoryTest extends TestCase
{
	private MockInterface $mockProduct;
	private ProductRepository $productRepository;
	
	protected function setUp(): void
	{
		parent::setUp();
		
		$this->mockProduct = Mockery::mock(Product::class);
		$this->productRepository = new ProductRepository($this->mockProduct);
	}
	
	protected function tearDown(): void
	{
		parent::tearDown();
		
		Mockery::close();
	}
	
	public function testStoreProductSuccessfully()
	{
		$storeProductDto = StoreProductDto::fromArray([
			'title' => 'Product Title',
			'price' => 9.99,
		]);
		
		$expectedProduct = new Product([
			"id" => 1,
			'title' => 'Product Title',
			'price' => 9.99,
		]);
		
		$this->mockProduct
			->shouldReceive('create')
			->with($storeProductDto->allowedInputs())
			->once()
			->andReturn($expectedProduct);
		
		$result = $this->productRepository->store($storeProductDto);
		
		$this->assertInstanceOf(Product::class, $result);
		$this->assertEquals($expectedProduct, $result);
	}
	
	public function testStoreProductFails()
	{
		$storeProductDto = StoreProductDto::fromArray([
			'title' => '',
			'price' => -1,
		]);
		
		$this->mockProduct
			->shouldReceive('create')
			->with($storeProductDto->allowedInputs())
			->once()
			->andReturn(null);
		
		$result = $this->productRepository->store($storeProductDto);
		
		$this->assertNull($result);
	}
}