<?php

namespace Philcross\ItcCompliance\Adapters;

use Philcross\ItcCompliance\Sdk\Sdk;
use Philcross\ItcCompliance\Models\Product;
use Philcross\ItcCompliance\Models\ProductOverview;

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
