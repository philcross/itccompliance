<?php

namespace Philcross\Itc\Transformers;

use Philcross\Itc\Models\Product;

class ProductTransformer
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
    public function toArray()
    {
        return [
            'id'          => $this->product->id(),
            'name'        => $this->product->name(),
            'description' => $this->product->description(),
            'type'        => $this->product->type(),
            'suppliers'   => $this->product->suppliers(),
        ];
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
}
