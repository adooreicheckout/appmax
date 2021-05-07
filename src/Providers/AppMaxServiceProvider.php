<?php

namespace Hdelima\AppMax\Providers;

use Illuminate\Support\ServiceProvider;
use Hdelima\AppMax\Services\AppMax as AppMaxClient;

class AppMaxServiceProvider extends ServiceProvider {

	protected $defer = false;

	public function boot()
	{	
		$this->publishes([
			__dir__ . '/../../config/config.php' => config_path('appmax.php'),
		]);

		$this->loadRoutesFrom( __dir__ . '/../../config/routes.php');

		$this->loadJsonTranslationsFrom( __dir__ . '/../../lang', 'appmax');

		$this->loadMigrationsFrom( __dir__ . '/../../migrations');
	}

	public function register()
	{
		$this->registerAppMax();

		$this->app->make('Hdelima\AppMax\Controllers\AppMaxNotificationController');

		$this->mergeConfig();
	}

	private function registerAppMax()
	{
		$this->app->singleton('appmax_client', static function () {
			return new AppMaxClient();
		});
	}

	private function mergeConfig()
	{
		$this->mergeConfigFrom(
			__dir__.'/../../config/config.php',
			'appmax'
		);
	}
}