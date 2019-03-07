<?php

namespace Philcross\ItcCompliance\Tests\Adapters;

use PHPUnit\Framework\TestCase;
use Philcross\ItcCompliance\Models\Product;
use Philcross\ItcCompliance\Models\ProductOverview;
use Philcross\ItcCompliance\Adapters\AdapterInterface;

abstract class AbstractAdapterTest extends TestCase
{
    /** @test */
    public function test_it_can_retrieve_a_list_of_products()
    {
        $products = $this->getAdapter()->listProducts();

        $this->assertIsArray($products, 'The product list returned is not an array');
        $this->assertCount(2, $products);

        foreach ($products as $product) {
            $this->assertInstanceOf(ProductOverview::class, $product);
        }
    }

    /** @test */
    public function test_it_can_retrieve_the_details_of_a_product()
    {
        $product = $this->getAdapter()->fetchProduct('smart');

        $this->assertInstanceOf(Product::class, $product);
    }

    /**
     * Return the adapter under test
     *
     * @return AdapterInterface
     */
    abstract protected function getAdapter(): AdapterInterface;
}
