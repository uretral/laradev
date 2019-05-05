<?php

namespace App\Models;

use Encore\Admin\Traits\AdminBuilder;
use Encore\Admin\Traits\ModelTree;
use Illuminate\Database\Eloquent\Model;

class Cats extends Model
{
    use ModelTree, AdminBuilder;
    protected $table = 'cats';
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setParentColumn('parent');
        $this->setOrderColumn('sort');
        $this->setTitleColumn('name');
    }

}
