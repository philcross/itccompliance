<?php

namespace Philcross\Itc\Sdk;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class Sdk
{
    /** @var Client */
    private $client;

    /** @var Request */
    private $lastRequest;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function products()
    {
        return new Products($this);
    }

    public function getLastRequest()
    {
        return $this->lastRequest;
    }

    public function call(Request $request)
    {
        $this->lastRequest = $request;

        $response = $this->client->send($request);

        return json_decode((string)$response->getBody(), true);
    }
}
