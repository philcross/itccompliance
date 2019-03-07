<?php

namespace Philcross\Itc\Models;

use Philcross\Itc\Traits\SanitizesValues;

class ProductOverview
{
    use SanitizesValues;

    /** @var string */
    private $id;

    /** @var string */
    private $name;

    /**
     * Constructor
     *
     * @param string $id
     * @param string $name
     */
    public function __construct(string $id, string $name)
    {
        $this->id   = $this->sanitizeString($id);
        $this->name = $this->sanitizeString($name);
    }

    /**
     * Return an array of ProductOverview instances from a service response.
     *
     * @param array $list
     *
     * @return array|ProductOverview[]
     */
    public static function fromResponse(array $list)
    {
        $products = $list['products'];

        return array_map(function ($id, $name) {
            return new static($id, $name);
        }, array_keys($products), $products);
    }

    /**
     * Return the product ID
     *
     * @return string
     */
    public function id()
    {
        return $this->id;
    }

    /**
     * Return the name of the product
     *
     * @return string
     */
    public function name()
    {
        return $this->name;
    }
}
