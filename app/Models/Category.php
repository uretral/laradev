<?php

namespace App\Models;

use Encore\Admin\Traits\AdminBuilder;
use Encore\Admin\Traits\ModelTree;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use ModelTree, AdminBuilder;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setParentColumn('parent');
        $this->setOrderColumn('sort');
        $this->setTitleColumn('name');
    }

    public static function updateSource($model, $blockAlias, $class)
    {
        $tbl = Category::where('id', $model->parent)->first();
        $block = Block::where('url', $blockAlias)->first();
        $newEl = array('id' => $model->id, 'nr' => $model->nr, 'url' => $block->url, 'name' => $block->name, 'controller' => $class, 'model' => $block->model, 'title' => $model->name);
        $json = $tbl->source;

        if ($json && strpos($json, $model->nr)) {
            $source = $json;
        } elseif ($json) {
            $arJson = json_decode($json);
            array_push($arJson, (object)$newEl);
            $source = json_encode($arJson, JSON_UNESCAPED_UNICODE);
        } else {
            $source = '[' . json_encode((object)$newEl, JSON_UNESCAPED_UNICODE) . ']';
        }

        Category::where('id', $model->parent)
            ->update(['source' => $source]);

        return redirect('/admin/categories/' . $model->parent . '/edit');
    }
}


