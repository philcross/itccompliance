<?php

namespace Philcross\Itc\Tests\Adapters;

use Philcross\Itc\Sdk\Sdk;
use Philcross\Itc\Sdk\Products;
use Philcross\Itc\Adapters\SdkAdapter;
use Philcross\Itc\Adapters\AdapterInterface;

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
