<?php

use Philcross\ItcCompliance\Http\EntryController;

include __DIR__ . '/vendor/autoload.php';

$controller = new EntryController;

$controller->index();
exit;
