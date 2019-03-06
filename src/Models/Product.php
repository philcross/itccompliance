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
}
