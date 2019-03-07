<?php

namespace Philcross\Itc\Tests\Transformers;

use PHPUnit\Framework\TestCase;
use Philcross\Itc\Models\ProductOverview;
use Philcross\Itc\Transformers\ProductOverviewTransformer;

class ProductOverviewTransformerTest extends TestCase
{
    /** @test */
    public function it_can_convert_a_product_to_an_array()
    {
        $product = new ProductOverview('test_id', 'Test Product');

        $transformer = new ProductOverviewTransformer($product);

        $this->assertEquals([
            'id'   => 'test_id',
            'name' => 'Test Product',
        ], $transformer->toArray());
    }

    /** @test */
    public function it_can_convert_a_product_to_a_json_string()
    {
        $product = new ProductOverview('test_id', 'Test Product');

        $transformer = new ProductOverviewTransformer($product);

        $this->assertEquals(json_encode([
            'id'   => 'test_id',
            'name' => 'Test Product',
        ]), $transformer->toJson());
    }
}
