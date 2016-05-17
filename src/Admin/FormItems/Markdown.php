<?php namespace Suroviy\SoaAddon\Admin\FormItems;

use SleepingOwl\Admin\FormItems\NamedFormItem;
use AssetManager;

class Markdown extends NamedFormItem
{

    public function initialize()
    {
        parent::initialize();

        AssetManager::addStyle(asset('vendor/suroviy/soa_addon/css/bootstrap-markdown-editor.css'));
        AssetManager::addScript(asset('vendor/suroviy/soa_addon/js/ace.js'));
        AssetManager::addScript(asset('vendor/suroviy/soa_addon/js/bootstrap-markdown-editor.js'));
    }

    public function render()
    {
        $params = $this->getParams();
        return view('suroviy.soa_addon::admin.form.markdown', $params);
    }

}