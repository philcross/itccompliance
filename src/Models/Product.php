<?php

namespace Philcross\Itc\Models;

class Product
{
    /** @var string */
    private $id;

    /** @var string */
    private $name;

    /** @var string */
    private $description;

    /** @var string */
    private $type;

    /** @var array */
    private $suppliers;

    public function __construct($id, $name, $description, $type, array $suppliers)
    {
        $this->id          = $id;
        $this->name        = $name;
        $this->description = $description;
        $this->type        = $type;
        $this->suppliers   = $suppliers;
    }

    /**
     * Constructor: Create a Product instance from a service response.
     *
     * @param string $id
     * @param array $product
     *
     * @return static
     */
    public static function fromResponse($id, array $product)
    {
        return new static(
            $id,
            $product['name'],
            $product['description'],
            $product['type'],
            $product['suppliers']
        );
    }
}
