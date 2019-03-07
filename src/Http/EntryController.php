<?php

namespace Philcross\ItcCompliance\Http;

class EntryController extends AbstractController
{
    /**
     * Main HTTP entry point to the application.
     *
     * @return void
     */
    public function index()
    {
        $this->send(ResponseFactory::text(file_get_contents(__DIR__ . '/../Views/index.php')));
    }
}
