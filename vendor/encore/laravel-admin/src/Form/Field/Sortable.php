<?php

namespace Encore\Admin\Form\Field;

use App\Models\Category;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form\Field;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Request;

class Sortable extends Field
{
    public static $css = [
        '/vendor/laravel-admin/nestable/nestable.css',
    ];
    public static $js = [
        '/vendor/laravel-admin/nestable/jquery.nestable.js',
        '/vendor/laravel-admin/uretral/sortable.page.js',

        '/vendor/laravel-admin/ckeditor/ckeditor.js',
        '/vendor/laravel-admin/ckeditor/adapters/jquery.js',
    ];

    /**
     * @var array
     */
    protected $groups = [];

    /**
     * @var array
     */
    protected $config = [];

    protected $res = '';


    public function check(){
        $json = json_decode($this->value());

        if($json){
            $val = [];
            foreach ($json as $j)if($j->model::find($j->id)){
                $val[] = $j;
            }
//            dump($val);
            Category::where('id',$this->res)->update(['source' => json_encode($val,JSON_UNESCAPED_UNICODE)]);
        }


    }






    /**
     * {@inheritdoc}
     */
    public function render()
    {



        $configs = array_merge([
            'allowClear'  => true,
            'placeholder' => [
                'id'   => '',
                'text' => $this->label,
            ],
        ], $this->config);

        $configs = json_encode($configs);


        $this->res = preg_replace("/[^,.0-9]/", '', Request::path());

        if (empty($this->script)) {
            $this->script = "$(\"{$this->getElementClassSelector()}\").select2($configs);";
        }

        if ($this->options instanceof \Closure) {
            if ($this->form) {
                $this->options = $this->options->bindTo($this->form->model());
            }

            $this->options(call_user_func($this->options, $this->value, $this));
        }

        $this->options = array_filter($this->options, 'strlen');
        $this->check();
        $this->addVariables([
            'options' => $this->options,
            'groups'  => $this->groups,
            'res'  => $this->res,
        ]);

        $this->attribute('data-value', implode(',', (array) $this->value()));



        return parent::render();
    }
}
