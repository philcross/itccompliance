<?php

namespace Philcross\ItcCompliance\Adapters;

use Philcross\ItcCompliance\Models\Product;
use Philcross\ItcCompliance\Models\ProductOverview;

class MemoryAdapter implements AdapterInterface
{
    /** @var array */
    private $overview;

    /** @var array */
    private $products;

    /**
     * Constructor
     *
     * @param array $overview
     * @param array $products
     */
    public function __construct(array $overview, array $products)
    {
        $this->overview = $overview;
        $this->products = $products;
    }

    /**
     * {@inheritdoc}
     */
    public function listProducts()
    {
        return ProductOverview::fromResponse($this->overview);
    }

    /**
     * {@inheritdoc}
     */
    public function fetchProduct(string $id)
    {
        return Product::fromResponse($id, $this->products[$id]);
    }
}
