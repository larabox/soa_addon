<?php

/*
 * This file is part of Laravel Markdown.
 *
 * (c) Graham Campbell <graham@alt-three.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Suroviy\SoaAddon;

use Webuni\CommonMark\TableExtension\TableExtension;
use Webuni\CommonMark\AttributesExtension\AttributesExtension;

use GrahamCampbell\Markdown\MarkdownServiceProvider as BaseProvider;

use Illuminate\Contracts\Container\Container;
//use Laravel\Lumen\Application as LumenApplication;
use League\CommonMark\Environment;

/**
 * This is the markdown service provider class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class MarkdownServiceProvider extends BaseProvider
{

    /**
     * Register the environment class.
     *
     * @return void
     */
    protected function registerEnvironment()
    {
        $this->app->singleton('markdown.environment', function (Container $app) {
            $environment = Environment::createCommonMarkEnvironment();
            $environment->addExtension(new TableExtension());
            $environment->addExtension(new AttributesExtension());

            $config = $app->config->get('markdown');

            $environment->mergeConfig(array_except($config, ['extensions', 'views']));

            foreach ((array) array_get($config, 'extensions') as $extension) {
                $environment->addExtension($app->make($extension));
            }

            return $environment;
        });

        $this->app->alias('markdown.environment', Environment::class);
    }

}