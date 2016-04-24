<?php namespace Suroviy\SoaAddon;

use Storage;
use View;
use FormItem;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;

class SoaAddonServiceProvider extends ServiceProvider {

	/**
	 * Define Service Providers from our dependencies
	 */
	protected $parent_providers = [
		\Radic\BladeExtensions\BladeExtensionsServiceProvider::class,
		\Grimthorr\LaravelUserSettings\ServiceProvider::class,
		\SleepingOwl\Admin\AdminServiceProvider::class,
		MarkdownServiceProvider::class
	];

	/**
	 * Define aliases to register
	 */
	protected $aliases = [
		'Markdown' 	=> \GrahamCampbell\Markdown\Facades\Markdown::class,
		'Setting'   => \Grimthorr\LaravelUserSettings\Facade::class,
	];

	protected function publishConfig($dir,$name){
		$config_file = $dir . '/../config/'.$name.'.php';

		$this->mergeConfigFrom($config_file, $name);

		$this->publishes([
			$config_file => config_path($name.'.php')
		], 'config');

	}

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{

		$this->loadViewsFrom(__DIR__.'/../views', 'suroviy.soa_addon');

		$this->publishConfig(__DIR__,'suroviy.soa_addon');

		$this->publishes([
			__DIR__.'/../publish' => base_path()
		]);

		FormItem::register('markdown', Admin\Form\Markdown::class);

		include __DIR__.'/../routes.php';
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->registerParentProviders();
		$this->registerAliases();
	}

	/**
	 * Register Dependency Providers
	 */
	protected function registerParentProviders()
	{
		foreach ($this->parent_providers as $parentProviderClass)
		{
			$this->app->register($parentProviderClass);
		}
	}

	/**
	 * Register the aliases from this module.
	 */
	protected function registerAliases()
	{
		$loader = AliasLoader::getInstance();
		foreach ($this->aliases as $aliasName => $aliasClass) {
			$loader->alias($aliasName, $aliasClass);
		}
	}

}