<?php

namespace Philcross\Itc\Tests\Sdk;

use GuzzleHttp\Client;
use Philcross\Itc\Sdk\Sdk;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Handler\MockHandler;

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

    private function getSdk($response)
    {
        $mock = new MockHandler([$response]);

        $client = new Client([
            'handler' => HandlerStack::create($mock)
        ]);

        return new Sdk($client);
    }
}
