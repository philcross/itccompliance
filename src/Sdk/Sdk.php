<?php

namespace Philcross\ItcCompliance\Sdk;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class Sdk
{
    /** @var Client */
    private $client;

    /** @var Request */
    private $lastRequest;

    /**
     * Constructor
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Return the products endpoint object
     *
     * @return Products
     */
    public function products()
    {
        return new Products($this);
    }

    /**
     * Return the last request made to the service
     *
     * @return Request
     */
    public function getLastRequest()
    {
        return $this->lastRequest;
    }

    /**
     * Send a request to the service, and handle any errors that are returned
     *
     * @param Request $request
     *
     * @return array
     *
     * @throws ClientException
     * @throws ServerException
     * @throws TransferException
     */
    public function call(Request $request)
    {
        $this->lastRequest = $request;

        try {
            $response = $this->client->send($request);

            $content = json_decode((string)$response->getBody(), true);

            if (array_key_exists('error', $content)) {
                throw new \GuzzleHttp\Exception\ServerException($content['error'], $request, $response);
            }

            return $content;
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            throw new ClientException($e->getMessage(), $this->lastRequest);
        } catch (\GuzzleHttp\Exception\ServerException $e) {
            throw new ServerException($e->getMessage(), $this->lastRequest);
        } catch (\GuzzleHttp\Exception\TransferException $e) {
            throw new TransferException($e->getMessage(), $this->lastRequest);
        }
    }
}
