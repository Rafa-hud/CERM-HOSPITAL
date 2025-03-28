<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
    use Illuminate\Support\Facades\Http;

class AppServiceProvider extends ServiceProvider
{

    public function boot()
    {
        Http::macro('api', function () {
            return Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->timeout(env('API_TIMEOUT', 30))
              ->baseUrl(env('API_BASE_URL'));
        });
    }


}
