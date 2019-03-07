<?php

use Philcross\Itc\Http\AjaxController;

include __DIR__ . '/vendor/autoload.php';

$controller = new AjaxController();

$controller->index();
exit;
