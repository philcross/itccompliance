<?php

namespace Philcross\ItcCompliance\Transformers;

use Philcross\ItcCompliance\Models\Product;

class ProductCollectionTransformer extends AbstractTransformer
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
    public function toArray(): array
    {
        return array_map(function (Product $product) {
            return (new ProductTransformer($product))->toArray();
        }, $this->products);
    }

    /**
     * Ensure each item is an instance of Product
     *
     * @param mixed $product
     *
     * @return bool
     */
    private function isProductInstance($product)
    {
        return $product instanceof Product;
    }
}
