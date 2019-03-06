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
        return array_map(
            [$this, 'mapToProductOverview'],
            array_keys($this->overview['products']),
            $this->overview['products']
        );
    }

    /**
     * {@inheritdoc}
     */
    public function fetchProduct(string $id)
    {
        return new Product(
            $id,
            $this->products[$id]['name'],
            $this->products[$id]['description'],
            $this->products[$id]['type'],
            $this->products[$id]['suppliers']
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
