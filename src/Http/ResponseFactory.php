<?php

namespace Philcross\ItcCompliance\Http;

use GuzzleHttp\Psr7\Response;

class ResponseFactory
{
    /**
     * Create a JSON response
     *
     * @param array $content
     * @param int   $status
     *
     * @return Response
     */
    public static function json(array $content = [], int $status = 200)
    {
        return new Response(
            $status,
            ['Content-Type' => 'application/json'],
            json_encode($content)
        );
    }

    /**
     * Create a standard plain text response
     *
     * @param string $content
     * @param int    $status
     *
     * @return Response
     */
    public static function text($content = '', int $status = 200)
    {
        return new Response(
            $status,
            ['Content-Type' => 'text/html'],
            $content
        );
    }
}
