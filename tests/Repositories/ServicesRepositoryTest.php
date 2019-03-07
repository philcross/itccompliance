<?php

namespace Philcross\Itc\Tests\Repositories;

use PHPUnit\Framework\TestCase;
use Philcross\Itc\Models\Product;
use Philcross\Itc\Models\ProductOverview;
use Philcross\Itc\Adapters\AdapterInterface;
use Philcross\Itc\Repositories\ServicesRepository;

class ServicesRepositoryTest extends TestCase
{
    /** @test */
    public function it_can_return_an_array_of_products()
    {
        $productListArray = include(__DIR__ . '/../Sdk/responses/list_response.php');
        $productsArray = include(__DIR__.'/../Sdk/responses/product_response.php');

        $adapter = \Mockery::mock(AdapterInterface::class);
        $adapter->shouldReceive('listProducts')->once()->andReturn(ProductOverview::fromResponse($productListArray));
        $adapter->shouldReceive('fetchProduct')->once()->with('combgap')->andReturn(Product::fromResponse('combgap', $productsArray['combgap']));
        $adapter->shouldReceive('fetchProduct')->once()->with('smart')->andReturn(Product::fromResponse('smart', $productsArray['smart']));

        $repository = new ServicesRepository($adapter);

        $products = $repository->fetchAllProducts();

        $this->assertIsArray($products);
        $this->assertCount(2, $products);

        foreach ($products as $product) {
            $this->assertInstanceOf(Product::class, $product);
        }
    }
}
