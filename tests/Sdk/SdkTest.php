<?php

namespace Philcross\ItcCompliance\Tests\Sdk;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Philcross\ItcCompliance\Sdk\Sdk;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Handler\MockHandler;
use Philcross\ItcCompliance\Sdk\ClientException;
use Philcross\ItcCompliance\Sdk\ServerException;
use Philcross\ItcCompliance\Sdk\TransferException;

class SdkTest extends TestCase
{
    /** @test */
    public function it_can_make_a_request_to_list_products()
    {
        $listResponse = include(__DIR__.'/responses/list_response.php');
        $response     = new Response(200, ['Content-type' => 'application/json'], json_encode($listResponse));

        $sdk    = $this->getSdk($response);
        $result = $sdk->products()->list();

        $this->assertEquals($listResponse, $result);

        $this->assertEquals('GET', $sdk->getLastRequest()->getMethod());
        $this->assertEquals('list', $sdk->getLastRequest()->getUri());
    }

    /** @test */
    public function it_can_make_a_request_to_retrieve_a_product()
    {
        $productResponse = include(__DIR__.'/responses/product_response.php');
        $response        = new Response(200, ['Content-type' => 'application/json'], json_encode($productResponse));

        $sdk    = $this->getSdk($response);
        $result = $sdk->products()->details('smart');

        $this->assertEquals($productResponse, $result);

        $this->assertEquals('GET', $sdk->getLastRequest()->getMethod());
        $this->assertEquals('info?id=smart', $sdk->getLastRequest()->getUri());
    }

    /** @test */
    public function it_throws_a_client_exception_if_the_service_returns_a_4xx_error()
    {
        $request  = new Request('GET', 'invalid');
        $response = new \GuzzleHttp\Exception\ClientException('client exception thrown', $request);

        $this->expectException(ClientException::class);

        $sdk = $this->getSdk($response);

        $sdk->call($request);
    }

    /** @test */
    public function it_throws_a_server_exception_if_the_service_returns_a_5xx_error()
    {
        $request  = new Request('GET', 'invalid');
        $response = new \GuzzleHttp\Exception\ServerException('server exception thrown', $request);

        $this->expectException(ServerException::class);

        $sdk = $this->getSdk($response);

        $sdk->call($request);
    }

    /** @test */
    public function it_throws_a_transfer_exception_if_there_was_an_error_during_transfer()
    {
        $request  = new Request('GET', 'invalid');
        $response = new \GuzzleHttp\Exception\RequestException('transfer exception thrown', $request);

        $this->expectException(TransferException::class);

        $sdk = $this->getSdk($response);

        $sdk->call($request);
    }

    /** @test */
    public function it_throws_a_server_exception_if_given_a_200_response_with_an_error_payload()
    {
        $errorPayload = ['error' => 'Data source error, please try again'];

        $response = new Response(200, ['Content-type' => 'application/json'], json_encode($errorPayload));

        $this->expectException(ServerException::class);

        $sdk = $this->getSdk($response);
        $sdk->products()->details('invalid');
    }

    private function getSdk($response)
    {
        $mock = new MockHandler([$response]);

        $client = new Client([
            'handler' => HandlerStack::create($mock)
        ]);

        return new Sdk($client);
    }
}
