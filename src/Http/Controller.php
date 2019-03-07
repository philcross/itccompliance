<?php

namespace Philcross\Itc\Http;

use GuzzleHttp\Client;
use Philcross\Itc\Adapters\SdkAdapter;
use Philcross\Itc\Repositories\ServicesRepository;
use Philcross\Itc\Sdk\Sdk;

class Controller
{
    public function index()
    {
        $client = new Client([
            'base_uri'    => 'https://www.itccompliance.co.uk/recruitment-webservice/api/',
            'verify'      => false,
            'http_errors' => true,
        ]);
        $sdk    = new Sdk($client);
        $adaper = new SdkAdapter($sdk);
        $repository = new ServicesRepository($adaper);

        var_dump($repository->fetchAllProducts());
    }
}
