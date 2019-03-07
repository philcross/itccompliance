<?php

namespace Philcross\ItcCompliance\Tests\Transformers;

use PHPUnit\Framework\TestCase;
use Philcross\ItcCompliance\Models\Product;
use Philcross\ItcCompliance\Transformers\ProductTransformer;
use Philcross\ItcCompliance\Transformers\ProductCollectionTransformer;

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

    /** @test */
    public function it_can_transform_an_array_of_products_to_an_array()
    {
        $products = [
            new Product('test_id_1', 'First Test Product', 'This is the first test', 'motor', ['test supplier 1']),
            new Product('test_id_2', 'Second Test Product', 'This is the second test', 'car', ['test supplier 2']),
        ];

        $transformer = new ProductCollectionTransformer($products);

        $this->assertEquals([
            [
                'id'          => 'test_id_1',
                'name'        => 'First Test Product',
                'description' => 'This is the first test',
                'type'        => 'motor',
                'suppliers'   => [
                    'test supplier 1',
                ],
            ], [
                'id'          => 'test_id_2',
                'name'        => 'Second Test Product',
                'description' => 'This is the second test',
                'type'        => 'car',
                'suppliers'   => [
                    'test supplier 2',
                ],
            ],
        ], $transformer->toArray());
    }

    /** @test */
    public function it_can_transform_an_array_of_products_to_a_json_string()
    {
        $products = [
            new Product('test_id_1', 'First Test Product', 'This is the first test', 'motor', ['test supplier 1']),
            new Product('test_id_2', 'Second Test Product', 'This is the second test', 'car', ['test supplier 2']),
        ];

        $transformer = new ProductCollectionTransformer($products);

        $this->assertEquals(json_encode([
            [
                'id'          => 'test_id_1',
                'name'        => 'First Test Product',
                'description' => 'This is the first test',
                'type'        => 'motor',
                'suppliers'   => [
                    'test supplier 1',
                ],
            ], [
                'id'          => 'test_id_2',
                'name'        => 'Second Test Product',
                'description' => 'This is the second test',
                'type'        => 'car',
                'suppliers'   => [
                    'test supplier 2',
                ],
            ],
        ]), $transformer->toJson());
    }
}
