<?php

namespace Philcross\ItcCompliance\Tests\Adapters;

use Philcross\ItcCompliance\Sdk\Sdk;
use Philcross\ItcCompliance\Sdk\Products;
use Philcross\ItcCompliance\Adapters\SdkAdapter;
use Philcross\ItcCompliance\Adapters\AdapterInterface;

class SdkAdapterTest extends AbstractAdapterTest
{
    protected function getAdapter(): AdapterInterface
    {
        $productListArray = include(__DIR__.'/../Sdk/responses/list_response.php');
        $productsArray = include(__DIR__.'/../Sdk/responses/product_response.php');

        $products = \Mockery::mock(Products::class);
        $products->shouldReceive('list')->once()->andReturn($productListArray);
        $products->shouldReceive('details')->once()->andReturn($productsArray);

        $sdk = \Mockery::mock(Sdk::class);
        $sdk->shouldReceive('products')->once()->andReturn($products);

        return new SdkAdapter($sdk);
    }
}
