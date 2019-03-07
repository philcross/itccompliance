<?php

namespace Philcross\Itc\Transformers;

use Philcross\Itc\Models\ProductOverview;

class ProductOverviewTransformer
{
    /** @var ProductOverview */
    private $overview;

    /**
     * Constructor
     *
     * @param ProductOverview $overview
     */
    public function __construct(ProductOverview $overview)
    {
        $this->overview = $overview;
    }

    /**
     * Convert the product to an array
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'id'          => $this->overview->id(),
            'name'        => $this->overview->name(),
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
