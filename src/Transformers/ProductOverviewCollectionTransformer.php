<?php

namespace Philcross\Itc\Transformers;

use Philcross\Itc\Models\ProductOverview;

class ProductOverviewCollectionTransformer extends AbstractTransformer
{
    /** @var array|ProductOverview[] */
    private $overviews;

    /**
     * Constructor
     *
     * @param array|ProductOverview[] $overviews
     */
    public function __construct(array $overviews)
    {
        $this->overviews = array_filter($overviews, [$this, 'isProductOverviewInstance']);
    }

    /**
     * Convert the product to an array
     *
     * @return array
     */
    public function toArray(): array
    {
        return array_map(function (ProductOverview $overview) {
            return (new ProductOverviewTransformer($overview))->toArray();
        }, $this->overviews);
    }

    private function isProductOverviewInstance($product)
    {
        return $product instanceof ProductOverview;
    }
}
