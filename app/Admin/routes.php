<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('admin.home');
    $router->resource('categories', CategoryController::class)->name('any','category');





    $router->resource('test', TestController::class);

    $router->resource('blocks', 'BlockController');

    if(strpos(Request::instance()->path(),'admin/block/') !== false){
        $block = \App\Models\Block::where('url',request()->segment(3))->first();
        $router->resource('block/'.$block->url, $block->controller);
        $router->resource('block/'.$block->url.'/{parent}', $block->controller);
    }
});
