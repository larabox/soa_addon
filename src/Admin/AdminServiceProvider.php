<?php namespace Suroviy\SoaAddon\Admin;

use SleepingOwl\Admin\AdminServiceProvider as ServiceProvider;

class AdminServiceProvider extends ServiceProvider
{

    /**
     * Define aliases to register
     */
    protected $aliases = [
        'Activation'    => \Cartalyst\Sentinel\Laravel\Facades\Activation::class,
        'Reminder'      => \Cartalyst\Sentinel\Laravel\Facades\Reminder::class,
        'Sentinel'      => \Cartalyst\Sentinel\Laravel\Facades\Sentinel::class,

        'Admin'         => \SleepingOwl\Admin\Admin::class,
        'Column'        => \SleepingOwl\Admin\Columns\Column::class,
        'ColumnFilter'  => \SleepingOwl\Admin\ColumnFilters\ColumnFilter::class,
        'Filter'        => \SleepingOwl\Admin\Filter\Filter::class,
        'AdminDisplay'  => \SleepingOwl\Admin\Display\AdminDisplay::class,
        'AdminForm'     => \Suroviy\SoaAddon\Admin\Form\AdminForm::class,
        'AdminTemplate' => \SleepingOwl\Admin\Templates\Facade\AdminTemplate::class,
        'FormItem'      => \Suroviy\SoaAddon\Admin\FormItems\FormItem::class,

        'JsValidator'   => \Proengsoft\JsValidation\Facades\JsValidatorFacade::class,
        'Flash'         => \Laracasts\Flash\Flash::class,
        'SoaUserSetting' 	=> \Grimthorr\LaravelUserSettings\Facade::class,
        'AssetManager'	=> \SleepingOwl\Admin\AssetManager\AssetManager::class
    ];


}