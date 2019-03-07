<?php

namespace Philcross\Itc\Tests\Http;

use PHPUnit\Framework\TestCase;
use Philcross\Itc\Http\ResponseFactory;
use Psr\Http\Message\ResponseInterface;

class ResponseFactoryTest extends TestCase
{
    /** @test */
    public function it_can_return_an_array_as_a_json_response()
    {
        $payload = [
            'i'       => 'have',
            'enjoyed' => 'this test',
        ];

        $response = ResponseFactory::json($payload, 200);

        $this->assertInstanceOf(ResponseInterface::class, $response);

        $this->assertEquals(['application/json'], $response->getHeader('Content-Type'));
        $this->assertEquals(json_encode([
            'i' => 'have',
            'enjoyed' => 'this test',
        ]), (string)$response->getBody());
    }

    /** @test */
    public function it_can_return_an_string_as_a_text_response()
    {
        $response = ResponseFactory::text('This is a test response', 200);

        $this->assertInstanceOf(ResponseInterface::class, $response);

        $this->assertEquals(['text/html'], $response->getHeader('Content-Type'));
        $this->assertEquals('This is a test response', (string)$response->getBody());
    }
}
