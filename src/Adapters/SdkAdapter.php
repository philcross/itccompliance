<?php

namespace Philcross\Itc\Adapters;

use Philcross\Itc\Sdk\Sdk;
use Philcross\Itc\Models\Product;
use Philcross\Itc\Models\ProductOverview;

class SdkAdapter
{
    /** @var Sdk */
    private $sdk;

    /**
     * Constructor
     *
     * @param Sdk $sdk
     */
    public function __construct(Sdk $sdk)
    {
        $this->sdk = $sdk;
    }

    /**
     * Return an array of ProductOverview objects, from the list of products
     * returned from the service.
     *
     * @return array|ProductOverview[]
     */
    public function listProducts()
    {
        $products = $this->sdk->products()->list();

        return array_map(
            [$this, 'mapToProductOverview'],
            array_keys($products['products']),
            $products['products']
        );
    }

    public function fetchProduct($id)
    {
        $product = $this->sdk->products()->details($id);

        return new Product(
            $id,
            $product[$id]['name'],
            $product[$id]['description'],
            $product[$id]['type'],
            $product[$id]['suppliers']
        );
    }

    /**
     * @param string $id
     * @param string $name
     *
     * @return ProductOverview
     */
    private function mapToProductOverview($id, $name)
    {
        return new ProductOverview($id, $name);
    }
}
