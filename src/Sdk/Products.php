<?php

namespace Philcross\Itc\Sdk;

use GuzzleHttp\Psr7\Request;

class Products
{
    private $sdk;

    public function __construct(Sdk $sdk)
    {
        $this->sdk = $sdk;
    }

    public function list()
    {
        return $this->sdk->call(
            new Request('GET', 'list')
        );
    }

    public function details($id)
    {
        return $this->sdk->call(
            new Request('GET', sprintf('info?id=%s', $id))
        );
    }
}
