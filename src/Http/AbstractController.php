<?php

namespace Philcross\ItcCompliance\Http;

use Psr\Http\Message\ResponseInterface;

abstract class AbstractController
{
    /**
     * Output the response back to the browser.
     *
     * @param ResponseInterface $response
     *
     * @return void
     */
    public function send(ResponseInterface $response)
    {
        $this->sendHeaders($response);

        echo (string)$response->getBody();
        exit;
    }

    /**
     * Output headers to the browser
     *
     * @param ResponseInterface $response
     *
     * @return void
     */
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
