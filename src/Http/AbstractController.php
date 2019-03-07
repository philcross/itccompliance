<?php

namespace Philcross\Itc\Http;

use Psr\Http\Message\ResponseInterface;

abstract class AbstractController
{
    public function send(ResponseInterface $response)
    {
        $this->sendHeaders($response);

        echo (string)$response->getBody();
        exit;
    }

    private function sendHeaders(ResponseInterface $response)
    {
        // headers
        foreach ($response->getHeaders() as $name => $values) {
            foreach ($values as $value) {
                header(sprintf('%s: %s', $name, $value), false);
            }
        }

        // status
        header(
            sprintf(
                'HTTP/%s %s %s',
                $response->getProtocolVersion(),
                $response->getStatusCode(),
                $response->getReasonPhrase()
            ),
            true,
            $response->getStatusCode()
        );
    }
}
