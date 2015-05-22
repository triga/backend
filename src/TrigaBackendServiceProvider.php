<?php namespace TrigaBackend;

use Illuminate\Support\ServiceProvider;

/**
 * TrigaBackend service provider.
 *
 * Class TrigaBackendServiceProvider
 * @package TrigaBackend
 */
class TrigaBackendServiceProvider extends ServiceProvider
{

    public function register()
    {
    }

    public function boot()
    {
        $this->loadViewsFrom(realpath(__DIR__ . '/../resources/views'), 'trigabackend');
    }

}
