<?php

namespace Philcross\Itc\Adapters;

use Philcross\Itc\Models\Product;
use Philcross\Itc\Models\ProductOverview;

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
