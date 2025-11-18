<?php

use Illuminate\Contracts\Http\Kernel as KernelContract;
use Illuminate\Http\Request;

require __DIR__.'/vendor/autoload.php';

$app = require __DIR__.'/bootstrap/app.php';

$kernel = $app->make(KernelContract::class);

$request = Request::create('/supervisor/dashboard', 'GET');

$response = $kernel->handle($request);

echo 'Status: '.$response->getStatusCode().PHP_EOL;
