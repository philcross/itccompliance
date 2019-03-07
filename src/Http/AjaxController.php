<?php

namespace Philcross\Itc\Http;

use GuzzleHttp\Client;
use Philcross\Itc\Sdk\Sdk;
use Philcross\Itc\Adapters\SdkAdapter;
use Philcross\Itc\Repositories\ServicesRepository;
use Philcross\Itc\Transformers\ProductCollectionTransformer;

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
