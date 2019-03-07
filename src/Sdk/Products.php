<?php

namespace Philcross\ItcCompliance\Sdk;

use GuzzleHttp\Psr7\Request;

class Products
{
    /** @var Sdk */
    private $sdk;

    /**
     * Constructor
     *
     * @param Sdk $sdk
     */
    public function __construct(Sdk $sdk)
    {
        $this->sdk = $sdk;
    }

    /**
     * Retrieve all the product overviews
     *
     * @return array
     *
     * @throws ClientException
     * @throws ServerException
     * @throws TransferException
     */
    public function list()
    {
        return $this->sdk->call(
            new Request('GET', 'list')
        );
    }

    /**
     * Return the details for a specified product
     *
     * @param string $id
     *
     * @return array
     *
     * @throws ClientException
     * @throws ServerException
     * @throws TransferException
     */
    public function details($id)
    {
        return $this->sdk->call(
            new Request('GET', sprintf('info?id=%s', $id))
        );
    }
}
