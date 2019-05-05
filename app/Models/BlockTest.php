<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlockTest extends Model
{
    protected $table = 'block_tests';

    public static function block($data){
        return view('blocks.test',[
            'data' => $data
        ]);
    }
}
