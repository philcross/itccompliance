<?php

namespace Philcross\Itc\Http;

class EntryController extends AbstractController
{
    public function index()
    {
        $this->send(ResponseFactory::text(file_get_contents(__DIR__ . '/../Views/index.php')));
    }
}
