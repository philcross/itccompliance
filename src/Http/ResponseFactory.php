<?php

namespace Philcross\ItcCompliance\Http;

use GuzzleHttp\Psr7\Response;

class ResponseFactory
{
    public static function json(array $content = [], int $status = 200)
    {
        return new Response(
            $status,
            ['Content-Type' => 'application/json'],
            json_encode($content)
        );
    }

    public static function text($content = '', int $status = 200)
    {
        return new Response($status, ['Content-Type' => 'text/html'], $content);
    }
}
