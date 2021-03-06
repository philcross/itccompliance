<?php

namespace Philcross\ItcCompliance\Sdk;

use GuzzleHttp\Psr7\Request;

abstract class SdkException extends \Exception
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
