<?php

namespace Philcross\ItcCompliance\Transformers;

abstract class AbstractTransformer
{
    /**
     * Convert the product to a json string
     *
     * @return string
     */
    public function toJson()
    {
        return json_encode($this->toArray());
    }

    /**
     * Convert the model to an array
     *
     * @return array
     */
    abstract public function toArray(): array;
}
