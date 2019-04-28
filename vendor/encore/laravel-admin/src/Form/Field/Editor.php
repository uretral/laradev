<?php

namespace Encore\Admin\Form\Field;

use Encore\Admin\Form\Field;

class Editor extends Field
{
    protected static $js = [
        '/vendor/laravel-admin/ckeditor/ckeditor.js',
        '/vendor/laravel-admin/ckeditor/adapters/jquery.js',
    ];

    public function render()
    {
        $this->script = "CKEDITOR.replace('{$this->id}');";

        return parent::render();
    }
}
