<?php

namespace MrMadClown\LaravelMultipartResponse;

use MrMadClown\LaravelMultipartResponse\Http\MultipartResponse;
use Illuminate\Routing\ResponseFactory;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function boot(): void
    {
        ResponseFactory::macro('multipart', function (array $elements, int $status = 200, array $headers = []) {
            return new MultipartResponse($elements, $status, $headers);
        });
    }
}
