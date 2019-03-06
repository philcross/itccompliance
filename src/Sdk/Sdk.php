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

        try {
            $response = $this->client->send($request);

            return json_decode((string)$response->getBody(), true);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            throw new ClientException($e->getMessage(), $this->lastRequest);
        } catch (\GuzzleHttp\Exception\ServerException $e) {
            throw new ServerException($e->getMessage(), $this->lastRequest);
        } catch (\GuzzleHttp\Exception\TransferException $e) {
            throw new TransferException($e->getMessage(), $this->lastRequest);
        }
    }
}
