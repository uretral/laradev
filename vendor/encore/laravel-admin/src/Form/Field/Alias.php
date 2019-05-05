<?php

namespace Encore\Admin\Form\Field;

use Encore\Admin\Form\Field;

class Alias extends Field
{
    public static $js = [
        '/vendor/laravel-admin/uretral/transliterator.js',
    ];

//    protected $view = 'admin.translit';

    public function render()
    {
        return parent::render();
    }
}
