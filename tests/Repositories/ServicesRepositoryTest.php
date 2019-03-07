<?php

namespace Philcross\ItcCompliance\Tests\Repositories;

use GuzzleHttp\Psr7\Request;
use PHPUnit\Framework\TestCase;
use Philcross\ItcCompliance\Models\Product;
use Philcross\ItcCompliance\Sdk\ClientException;
use Philcross\ItcCompliance\Models\ProductOverview;
use Philcross\ItcCompliance\Adapters\AdapterInterface;
use Philcross\ItcCompliance\Repositories\ServicesRepository;

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

    /** @test */
    public function it_keeps_retrying_to_list_products_upon_failure()
    {
        $productListArray = include(__DIR__ . '/../Sdk/responses/list_response.php');
        $productsArray = include(__DIR__.'/../Sdk/responses/product_response.php');

        $adapter = \Mockery::mock(AdapterInterface::class);
        $adapter->shouldReceive('listProducts')->andReturnUsing(function () use ($productListArray) {
            static $initialReturn = true;

            if ($initialReturn) {
                $initialReturn = false;
                throw new ClientException('', new Request('GET', 'list'));
            }

            return ProductOverview::fromResponse($productListArray);
        });
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

    /** @test */
    public function it_keeps_retrying_to_fetch_products_upon_failure()
    {
        $productListArray = include(__DIR__ . '/../Sdk/responses/list_response.php');
        $productsArray = include(__DIR__.'/../Sdk/responses/product_response.php');

        $adapter = \Mockery::mock(AdapterInterface::class);
        $adapter->shouldReceive('listProducts')->once()->andReturn(ProductOverview::fromResponse($productListArray));
        $adapter->shouldReceive('fetchProduct')->once()->with('combgap')->andReturn(Product::fromResponse('combgap', $productsArray['combgap']));
        $adapter->shouldReceive('fetchProduct')->once()->with('smart')->andReturnUsing(function () use ($productsArray) {
            static $initialReturn = true;

            if ($initialReturn) {
                $initialReturn = false;
                throw new ClientException('', new Request('GET', 'list'));
            }

            return Product::fromResponse('smart', $productsArray['smart']);
        });

        $repository = new ServicesRepository($adapter);

        $products = $repository->fetchAllProducts();

        $this->assertIsArray($products);
        $this->assertCount(2, $products);

        foreach ($products as $product) {
            $this->assertInstanceOf(Product::class, $product);
        }
    }
}
