<?php

namespace Philcross\Itc\Sdk;

use GuzzleHttp\Psr7\Request;

class ServerException extends \Exception
{
    /** @var Request */
    private $lastRequest;

    /**
     * Constructor
     *
     * @param string  $message
     * @param Request $request
     */
    public function __construct(string $message, Request $request)
    {
        parent::__construct($message);

        $this->lastRequest = $request;
    }

    /**
     * @return Request
     */
    public function getLastRequest()
    {
        return $this->lastRequest;
    }
}
