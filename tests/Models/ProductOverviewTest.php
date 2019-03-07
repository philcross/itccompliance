<?php

namespace Philcross\ItcCompliance\Tests\Models;

use PHPUnit\Framework\TestCase;
use Philcross\ItcCompliance\Models\ProductOverview;

class ProductOverviewTest extends TestCase
{
    /** @test */
    public function a_new_instance_of_the_model_can_be_created()
    {
        $product = new ProductOverview('test_id', 'Test Product');

        $this->assertInstanceOf(ProductOverview::class, $product);
        $this->assertEquals('test_id', $product->id());
        $this->assertEquals('Test Product', $product->name());
    }

    /** @test */
    public function a_new_instance_can_be_created_from_a_valid_response()
    {
        $products = ProductOverview::fromResponse([
            'products' => [
                'test_id' => 'Test Product'
            ]
        ]);

        $this->assertIsArray($products);

        foreach ($products as $productOverview) {
            $this->assertInstanceOf(ProductOverview::class, $productOverview);
            $this->assertEquals('test_id', $productOverview->id());
            $this->assertEquals('Test Product', $productOverview->name());
        }
    }

    /** @test */
    public function it_can_clean_product_values()
    {
        $products = ProductOverview::fromResponse([
            'products' => [
                'test_id' => '"Test <span style="display: none;">1234567890</div>Product"'
            ]
        ]);

        $this->assertInstanceOf(ProductOverview::class, $products[0]);
        $this->assertEquals('test_id', $products[0]->id());
        $this->assertEquals('Test Product', $products[0]->name());
    }
}
