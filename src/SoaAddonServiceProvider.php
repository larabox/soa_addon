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

		FormItem::register('markdown', Admin\FormItems\Markdown::class);

		/*
		FormItem::register('bootstrapselect', Admin\FormItems\BootstrapSelect::class);
		FormItem::register('checkbox', Admin\FormItems\Checkbox::class);
		FormItem::register('chosen', Admin\FormItems\Chosen::class);
		FormItem::register('CKEditor', Admin\FormItems\ckeditor::class);
		FormItem::register('colorpicker', Admin\FormItems\Colorpicker::class);
		FormItem::register('columns', Admin\FormItems\Columns::class);
		FormItem::register('custom', Admin\FormItems\Custom::class);
		FormItem::register('date', Admin\FormItems\Date::class);
		FormItem::register('file', Admin\FormItems\File::class);
		FormItem::register('filemanager', Admin\FormItems\Filemanager::class);
		FormItem::register('hidden', Admin\FormItems\Hidden::class);
		FormItem::register('image', Admin\FormItems\Image::class);
		FormItem::register('images', Admin\FormItems\Images::class);
		FormItem::register('multiselect', Admin\FormItems\MultiSelect::class);
		FormItem::register('password', Admin\FormItems\Password::class);
		FormItem::register('permissions', Admin\FormItems\Permissions::class);
		FormItem::register('radio', Admin\FormItems\Radio::class);
		FormItem::register('roles', Admin\FormItems\Roles::class);
		FormItem::register('select', Admin\FormItems\Select::class);
		FormItem::register('select2', Admin\FormItems\Select2::class);
		FormItem::register('sentinelpassword', Admin\FormItems\SentinelPassword::class);
		FormItem::register('text', Admin\FormItems\Text::class);
		FormItem::register('textaddon', Admin\FormItems\TextAddon::class);
		FormItem::register('textarea', Admin\FormItems\Textarea::class);
		FormItem::register('time', Admin\FormItems\Time::class);
		FormItem::register('timestamp', Admin\FormItems\Timestamp::class);
		FormItem::register('tinymce', Admin\FormItems\TinyMCE::class);
		FormItem::register('view', Admin\FormItems\View::class);
		FormItem::register('icheckbox', Admin\FormItems\ICheckbox::class);
		FormItem::register('switchcheckbox', Admin\FormItems\SwitchCheckbox::class);
		FormItem::register('switchradio', Admin\FormItems\SwitchRadio::class);
		FormItem::register('iradio', Admin\FormItems\IRadio::class);
		FormItem::register('typeahead', Admin\FormItems\typeahead::class);
		*/



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