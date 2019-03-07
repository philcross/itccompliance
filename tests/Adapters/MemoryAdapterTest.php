<?php

namespace Philcross\ItcCompliance\Tests\Adapters;

use Philcross\ItcCompliance\Adapters\MemoryAdapter;
use Philcross\ItcCompliance\Adapters\AdapterInterface;

class MemoryAdapterTest extends AbstractAdapterTest
{
    protected function getAdapter(): AdapterInterface
    {
        $productList = include(__DIR__.'/../Sdk/responses/list_response.php');
        $products = include(__DIR__.'/../Sdk/responses/product_response.php');

        return new MemoryAdapter($productList, $products);
    }
}
