<?php

namespace Philcross\ItcCompliance\Tests\Transformers;

use PHPUnit\Framework\TestCase;
use Philcross\ItcCompliance\Models\ProductOverview;
use Philcross\ItcCompliance\Transformers\ProductOverviewTransformer;
use Philcross\ItcCompliance\Transformers\ProductOverviewCollectionTransformer;

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

    /** @test */
    public function it_can_transform_an_array_of_product_overviews_to_an_array()
    {
        $overviews = [
            new ProductOverview('test_id_1', 'First Test Product'),
            new ProductOverview('test_id_2', 'Second Test Product'),
        ];

        $transformer = new ProductOverviewCollectionTransformer($overviews);

        $this->assertEquals([
            [
                'id'   => 'test_id_1',
                'name' => 'First Test Product',
            ],
            [
                'id'   => 'test_id_2',
                'name' => 'Second Test Product',
            ],
        ], $transformer->toArray());
    }

    /** @test */
    public function it_can_transform_an_array_of_product_overviews_to_a_json_string()
    {
        $overviews = [
            new ProductOverview('test_id_1', 'First Test Product'),
            new ProductOverview('test_id_2', 'Second Test Product'),
        ];

        $transformer = new ProductOverviewCollectionTransformer($overviews);

        $this->assertEquals(json_encode([
            [
                'id'   => 'test_id_1',
                'name' => 'First Test Product',
            ],
            [
                'id'   => 'test_id_2',
                'name' => 'Second Test Product',
            ],
        ]), $transformer->toJson());
    }
}
