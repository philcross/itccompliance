<?php

namespace Philcross\ItcCompliance\Http;

use GuzzleHttp\Client;
use Philcross\ItcCompliance\Sdk\Sdk;
use Philcross\ItcCompliance\Adapters\SdkAdapter;
use Philcross\ItcCompliance\Repositories\ServicesRepository;
use Philcross\ItcCompliance\Transformers\ProductCollectionTransformer;

class AjaxController extends AbstractController
{
    const API_ENDPOINT = 'https://www.itccompliance.co.uk/recruitment-webservice/api/';

    public function index()
    {
        $client = new Client([
            'base_uri'    => self::API_ENDPOINT,
            'verify'      => false,
            'http_errors' => true,
        ]);
        $sdk    = new Sdk($client);
        $adapter = new SdkAdapter($sdk);
        $repository = new ServicesRepository($adapter);

        $transformer = new ProductCollectionTransformer($repository->fetchAllProducts());

        $this->send(ResponseFactory::json($transformer->toArray()));
    }
}
