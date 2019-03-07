<?php

namespace Philcross\ItcCompliance\Transformers;

use Philcross\ItcCompliance\Models\ProductOverview;

class ProductOverviewTransformer extends AbstractTransformer
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
    public function toArray(): array
    {
        return [
            'id'          => $this->overview->id(),
            'name'        => $this->overview->name(),
        ];
    }
}
