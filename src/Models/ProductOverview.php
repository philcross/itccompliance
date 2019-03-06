<?php

namespace Philcross\Itc\Models;

class ProductOverview
{
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
        $this->id   = $id;
        $this->name = $name;
    }
}
