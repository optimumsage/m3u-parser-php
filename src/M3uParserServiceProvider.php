<?php

namespace OptimumSage\M3uParser;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class M3uParserServiceProvider extends ServiceProvider  {
    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot() {
        AliasLoader::getInstance()->alias('m3uParser', M3uParser::class);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('m3uParser', function () {
            return $this->app->make(M3uParser::class);
        });
    }

}
