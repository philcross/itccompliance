<?php

namespace Philcross\Itc\Adapters;

use Philcross\Itc\Sdk\Sdk;
use Philcross\Itc\Models\Product;
use Philcross\Itc\Models\ProductOverview;

class SdkAdapter implements AdapterInterface
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
     * {@inheritdoc}
     */
    public function listProducts()
    {
        $products = $this->sdk->products()->list();

        return ProductOverview::fromResponse($products);
    }

    /**
     * {@inheritdoc}
     */
    public function fetchProduct(string $id)
    {
        $product = $this->sdk->products()->details($id);

        return Product::fromResponse($id, $product[$id]);
    }
}
