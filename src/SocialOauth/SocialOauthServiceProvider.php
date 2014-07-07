<?php namespace Svabael\SocialOauth;

use Illuminate\Support\ServiceProvider;

class SocialOauthServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('svabael/social-oauth');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		//
    $app = $this->app;
    $app['config']->package('svabael/social-oauth', 'svabael/social-oauth', 'Svabael/SocialOauth');
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}
