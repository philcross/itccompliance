<?php

namespace Philcross\Itc\Tests\Adapters;

use Philcross\Itc\Sdk\Sdk;
use Philcross\Itc\Sdk\Products;
use PHPUnit\Framework\TestCase;
use Philcross\Itc\Models\Product;
use Philcross\Itc\Adapters\SdkAdapter;
use Philcross\Itc\Models\ProductOverview;

class SdkAdapterTest extends TestCase
{
    /** @test */
    public function test_it_can_retrieve_a_list_of_products()
    {
        $productList = include(__DIR__.'/../Sdk/responses/list_response.php');

        $products = \Mockery::mock(Products::class);
        $products->shouldReceive('list')->once()->andReturn($productList);

        $sdk = \Mockery::mock(Sdk::class);
        $sdk->shouldReceive('products')->once()->andReturn($products);

        $httpAdapter = new SdkAdapter($sdk);

        $products = $httpAdapter->listProducts();

        $this->assertIsArray($products, 'The product list returned is not an array');
        $this->assertCount(2, $products);

        foreach ($products as $product) {
            $this->assertInstanceOf(ProductOverview::class, $product);
        }
    }

    /** @test */
    public function test_it_can_retrieve_the_details_of_a_product()
    {
        $productList = include(__DIR__.'/../Sdk/responses/product_response.php');

        $products = \Mockery::mock(Products::class);
        $products->shouldReceive('details')->once()->andReturn($productList);

        $sdk = \Mockery::mock(Sdk::class);
        $sdk->shouldReceive('products')->once()->andReturn($products);

        $httpAdapter = new SdkAdapter($sdk);

        $product = $httpAdapter->fetchProduct('smart');

        $this->assertInstanceOf(Product::class, $product);
    }
}
