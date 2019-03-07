<?php

namespace Philcross\ItcCompliance\Models;

use Philcross\ItcCompliance\Traits\SanitizesValues;

class Product
{
    use SanitizesValues;

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
        $this->id          = $this->sanitizeString($id);
        $this->name        = $this->sanitizeString($name);
        $this->description = $this->sanitizeString($description);
        $this->type        = $this->sanitizeString($type);
        $this->suppliers   = $this->sanitizeArray($suppliers);
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
            array_key_exists('name', $product) ? $product['name'] : null,
            array_key_exists('description', $product) ? $product['description'] : null,
            array_key_exists('type', $product) ? $product['type'] : null,
            array_key_exists('suppliers', $product) ? $product['suppliers'] : []
        );
    }

    /**
     * @return string
     */
    public function id()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function name()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function description()
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function type()
    {
        return $this->type;
    }

    /**
     * @return array
     */
    public function suppliers()
    {
        return $this->suppliers;
    }
}
