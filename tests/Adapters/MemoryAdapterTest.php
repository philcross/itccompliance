<?php

namespace Philcross\Itc\Tests\Adapters;

use PHPUnit\Framework\TestCase;
use Philcross\Itc\Models\Product;
use Philcross\Itc\Adapters\MemoryAdapter;
use Philcross\Itc\Models\ProductOverview;

class MemoryAdapterTest extends TestCase
{
    /** @test */
    public function test_it_can_retrieve_a_list_of_products()
    {
        $productList = include(__DIR__.'/../Sdk/responses/list_response.php');

        $memoryAdapter = new MemoryAdapter($productList, []);

        $products = $memoryAdapter->listProducts();

        $this->assertIsArray($products, 'The product list returned is not an array');
        $this->assertCount(2, $products);

        foreach ($products as $product) {
            $this->assertInstanceOf(ProductOverview::class, $product);
        }
    }

    /** @test */
    public function test_it_can_retrieve_the_details_of_a_product()
    {
        $products = include(__DIR__.'/../Sdk/responses/product_response.php');

        $memoryAdapter = new MemoryAdapter([], $products);

        $product = $memoryAdapter->fetchProduct('smart');

        $this->assertInstanceOf(Product::class, $product);
    }
}
