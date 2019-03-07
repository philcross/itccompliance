<?php

namespace Philcross\ItcCompliance\Tests\Models;

use PHPUnit\Framework\TestCase;
use Philcross\ItcCompliance\Models\Product;

class ProductTest extends TestCase
{
    /** @test */
    public function a_new_instance_of_the_model_can_be_created()
    {
        $product = new Product('test_id', 'Test Product', 'This is the test description', 'motor', ['test supplier']);

        $this->assertInstanceOf(Product::class, $product);
        $this->assertEquals('test_id', $product->id());
        $this->assertEquals('Test Product', $product->name());
        $this->assertEquals('This is the test description', $product->description());
        $this->assertEquals('motor', $product->type());
        $this->assertEquals(['test supplier'], $product->suppliers());
    }

    /** @test */
    public function a_new_instance_can_be_created_from_a_valid_response()
    {
        $product = Product::fromResponse('test_id', [
            'name'        => 'Test Product',
            'description' => 'This is the test description',
            'type'        => 'motor',
            'suppliers'   => [
                'test supplier',
            ]
        ]);

        $this->assertInstanceOf(Product::class, $product);
        $this->assertEquals('test_id', $product->id());
        $this->assertEquals('Test Product', $product->name());
        $this->assertEquals('This is the test description', $product->description());
        $this->assertEquals('motor', $product->type());
        $this->assertEquals(['test supplier'], $product->suppliers());
    }

    /** @test */
    public function it_can_create_a_new_instance_from_a_response_with_missing_data()
    {
        $product = Product::fromResponse('test_id', [
            'name'        => 'Test Product',
            'description' => 'This is the test description',
        ]);

        $this->assertInstanceOf(Product::class, $product);
        $this->assertEquals('test_id', $product->id());
        $this->assertEquals('Test Product', $product->name());
        $this->assertEquals('This is the test description', $product->description());
        $this->assertEquals(null, $product->type());
        $this->assertEquals([], $product->suppliers());
    }

    /** @test */
    public function it_can_clean_product_values()
    {
        $product = Product::fromResponse('test_id', [
            'name'        => 'Test Product',
            'description' => '"This is the test description"',
            'type'        => 'motor',
            'suppliers'   => [
                'test <span style="display: none">1234567890</div>supplier',
                "\x00\"quoted supplier\"\x01"
            ]
        ]);

        $this->assertInstanceOf(Product::class, $product);
        $this->assertEquals('test_id', $product->id());
        $this->assertEquals('Test Product', $product->name());
        $this->assertEquals('This is the test description', $product->description());
        $this->assertEquals('motor', $product->type());
        $this->assertEquals(['test supplier', 'quoted supplier'], $product->suppliers());
    }
}
