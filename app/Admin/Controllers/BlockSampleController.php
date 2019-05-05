<?php

namespace App\Admin\Controllers;

use App\Models\BlockSample;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Illuminate\Support\Facades\Request;
use PhpParser\Node\Expr\PostDec;

class BlockSampleController extends Controller
{
    use HasResourceActions;

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header('Index')
            ->description('description')
            ->body($this->grid());
    }

    /**
     * Show interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function show($id, Content $content)
    {
        return $content
            ->header('Detail')
            ->description('description')
            ->body($this->detail($id));
    }

    /**
     * Edit interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->header('Edit')
            ->description('description')
            ->body($this->form()->edit($id));
    }

    /**
     * Create interface.
     *
     * @param Content $content
     * @return Content
     */
    public function create(Content $content)
    {
        return $content
            ->header('Create')
            ->description('description')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new BlockSample);

        $grid->id('ID');
        $grid->name('Название');
        //$grid->intro_img('Превью');

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(BlockSample::findOrFail($id));

        $show->id('ID');
        $show->created_at('Created at');
        $show->updated_at('Updated at');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new BlockSample);

        $form->tab('Настройки', function($form){
            $form->display('id','ID');
            $form->text('nr')->default(Request::get('nr'));
            $form->text('parent')->default(Request::get('parent'));
            $form->text('name','Название')->attribute('rel','alias');
        });
        $form->tab('Превью', function($form){

            $form->image('intro_img','Иконка');
            $form->textarea('intro','Интро текст');
        });
        $form->tab('Контент', function($form){
            $form->image('detail_img','Картинка');
            $form->ckeditor('detail','Текст');
        });
        $form->tab('SEO', function($form){
            $form->textarea('seo_title','seo title');
            $form->textarea('seo_desc','seo description');
            $form->textarea('seo_key','seo keywords');
        });

        $form->saved(function (Form $form) {
            if (\request()->segment(5) != 'edit')
                return Category::updateSource($form->model(), \request()->segment(3), get_class($this));

            /*            $tbl = Category::where('id',$form->model()->parent)->first();
                        $block = Block::where('url',\request()->segment(3))->first();
                        $newEl = array('nr' => $form->model()->nr,'url' => $block->url,'name' => $block->name,'controller' => get_class($this),'model' => $block->controller);
                        $json = $tbl->source;
                        if($json){
                            $arJson =  json_decode($json);
                            array_push($arJson,(object)$newEl);
                        }else {
                            $arJson = (object)$newEl;
                        }
                        Category::where('id',$form->model()->parent)
                            ->update(['source'=> '['.json_encode($arJson,JSON_UNESCAPED_UNICODE).']']);
                        return redirect('/admin/categories/'.$form->model()->parent.'/edit');*/

        });



        $form->display('Created at');
        $form->display('Updated at');

        return $form;
    }
}
