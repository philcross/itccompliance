<?php

namespace Philcross\ItcCompliance\Transformers;

use Philcross\ItcCompliance\Models\Product;

class ProductTransformer extends AbstractTransformer
{
    /** @var Product */
    private $product;

    /**
     * Constructor
     *
     * @param Product $product
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * Convert the product to an array
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id'          => $this->product->id(),
            'name'        => $this->product->name(),
            'description' => $this->product->description(),
            'type'        => $this->product->type(),
            'suppliers'   => $this->product->suppliers(),
        ];
    }
}
