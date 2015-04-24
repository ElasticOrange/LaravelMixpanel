<?php namespace Hydrarulz\LaravelMixpanel;

use Illuminate\Support\ServiceProvider;
use Config;

class LaravelMixpanelServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../../../config/config.php' => base_path('config/laravel-mixpanel.php')
        ]);
    }

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->singleton('mixpanel', function()
		{
			$token = Config::get('laravel-mixpanel.token');

            return new LaravelMixpanel($token);
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return ['mixpanel'];
	}

}
