<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);

        // Tambahkan custom disk Supabase
        Storage::extend('supabase', function ($app, $config) {
            return new class($config) {
                protected $config;

                public function __construct($config)
                {
                    $this->config = $config;
                }

                public function put($path, $contents)
                {
                    $url = $this->config['url'].'/storage/v1/object/'.$this->config['bucket'].'/'.$path;

                    $response = Http::withHeaders([
                        'apikey' => $this->config['key'],
                        'Authorization' => 'Bearer '.$this->config['key'],
                    ])->attach(
                        'file', $contents, basename($path)
                    )->post($url);

                    return $response->successful();
                }

                public function url($path)
                {
                    return $this->config['url'].'/storage/v1/object/public/'.$this->config['bucket'].'/'.$path;
                }
            };
        });
    }
}
