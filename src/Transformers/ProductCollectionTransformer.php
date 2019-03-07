<?php

namespace Philcross\Itc\Transformers;

use Philcross\Itc\Models\Product;

class ProductCollectionTransformer
{
    /** @var array|Product[] */
    private $products;

    /**
     * Constructor
     *
     * @param array|Product[] $products
     */
    public function __construct(array $products)
    {
        $this->products = array_filter($products, [$this, 'isProductInstance']);
    }

    /**
     * Convert the product to an array
     *
     * @return array
     */
    public function toArray()
    {
        return array_map(function (Product $product) {
            return (new ProductTransformer($product))->toArray();
        }, $this->products);
    }

    /**
     * Convert the product to a json string
     *
     * @return string
     */
    public function toJson()
    {
        return json_encode($this->toArray());
    }

    private function isProductInstance($product)
    {
        return $product instanceof Product;
    }
}
