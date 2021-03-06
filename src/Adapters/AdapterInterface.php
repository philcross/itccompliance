<?php

namespace Philcross\ItcCompliance\Adapters;

use Philcross\ItcCompliance\Models\Product;
use Philcross\ItcCompliance\Models\ProductOverview;

interface AdapterInterface
{
    /**
     * Return an array of ProductOverview objects, from the list of products
     * returned from the service.
     *
     * @return array|ProductOverview[]
     */
    public function listProducts();

    /**
     * Return a product for a given ID
     *
     * @param string $id
     *
     * @return Product
     */
    public function fetchProduct(string $id);
}
