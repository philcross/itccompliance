<?php

namespace Philcross\Itc\Tests\Transformers;

use PHPUnit\Framework\TestCase;
use Philcross\Itc\Models\Product;
use Philcross\Itc\Transformers\ProductTransformer;

class ProductTransformerTest extends TestCase
{
    /** @test */
    public function it_can_convert_a_product_to_an_array()
    {
        $product = new Product('test_id', 'Test Product', 'This is a test', 'motor', ['test supplier']);

        $transformer = new ProductTransformer($product);

        $this->assertEquals([
            'id'          => 'test_id',
            'name'        => 'Test Product',
            'description' => 'This is a test',
            'type'        => 'motor',
            'suppliers'   => [
                'test supplier',
            ],
        ], $transformer->toArray());
    }

    /** @test */
    public function it_can_convert_a_product_to_a_json_string()
    {
        $product = new Product('test_id', 'Test Product', 'This is a test', 'motor', ['test supplier']);

        $transformer = new ProductTransformer($product);

        $this->assertEquals(json_encode([
            'id'          => 'test_id',
            'name'        => 'Test Product',
            'description' => 'This is a test',
            'type'        => 'motor',
            'suppliers'   => [
                'test supplier',
            ],
        ]), $transformer->toJson());
    }
}
