<?php

namespace Philcross\Itc\Repositories;

use Philcross\Itc\Adapters\AdapterInterface;

class ServicesRepository
{
    /** @var AdapterInterface */
    private $adapter;

    /**
     * Constructor
     *
     * @param AdapterInterface $adapter
     */
    public function __construct(AdapterInterface $adapter)
    {
        $this->adapter = $adapter;
    }

    /**
     * Return an array of all products provided by the service
     * 
     * @return array
     */
    public function fetchAllProducts()
    {
        $products = [];

        foreach ($this->adapter->listProducts() as $overview) {
            $products[] = $this->adapter->fetchProduct($overview->id());
        }

        return $products;
    }
}
