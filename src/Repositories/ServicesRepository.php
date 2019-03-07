<?php

namespace Philcross\Itc\Repositories;

use Philcross\Itc\Models\Product;
use Philcross\Itc\Sdk\SdkException;
use Philcross\Itc\Models\ProductOverview;
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

        foreach ($this->listProducts() as $overview) {
            $products[] = $this->fetchProduct($overview->id());
        }

        return $products;
    }

    /**
     * Keep attempting to fetch products from the service. This is a recursive call method.
     * If an SDK exception is caught, it will recall the method until we get a valid response.
     *
     * @return array|ProductOverview[]
     */
    private function listProducts()
    {
        try {
            return $this->adapter->listProducts();
        } catch (SdkException $e) {
            return $this->listProducts();
        }
    }

    /**
     * Keep attempting to fetch a specific product from the service. This is a recursive call method,
     * similar to the listProducts method. It will keep trying to retrieve the product if the service
     * returns an error.
     *
     * @param string $id
     *
     * @return Product
     */
    private function fetchProduct($id)
    {
        try {
            return $this->adapter->fetchProduct($id);
        } catch (SdkException $e) {
            return $this->fetchProduct($id);
        }
    }
}
