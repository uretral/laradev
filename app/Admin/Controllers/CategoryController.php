<?php

namespace App\Admin\Controllers;

use App\Models\Block;
use App\Models\BlockTest;
use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Models\Test;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Tree;
use Illuminate\Support\Facades\Request;

class CategoryController extends Controller
{
    use ModelForm;

    /**
     * Index interface.
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {
            $content->header('Categories');
            $content->body(Category::tree(function ($tree) {
                $tree->branch(function ($branch) {
                    return "{$branch['id']} - {$branch['name']} ";
                });
            }));
        });
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
            ->body($this->formShort());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Category);

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
        $show = new Show(Category::findOrFail($id));

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
        $form = new Form(new Category);

        $form->tab('Конструктор страницы', function($form){
            $form->sortable('source','Страница');
            $form->select('blocks','Добавить блок')->options(Block::all()->pluck('name','url'));

        });
        $form->tab('Настройки', function($form){
            $form->display('ID');
            $form->alias('alias','Алиас');
            $form->text('name','Название');
        });
        $form->tab('SEO', function($form){
            $form->textarea('seo_title','seo title');
            $form->textarea('seo_desc','seo description');
            $form->textarea('seo_key','seo keywords');

        });


        return $form;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function formShort()
    {
        $form = new Form(new Category);

        $form->tab('Настройки', function($form){
            $form->display('ID');
            $form->alias('alias','Алиас');
            $form->text('name','Название');
        });
        $form->tab('SEO', function($form){
            $form->textarea('seo_title','seo title');
            $form->textarea('seo_desc','seo description');
            $form->textarea('seo_key','seo keywords');

        });

        return $form;
    }

    public function block($alias,$id){
        $block = Block::where('url',$alias)->first();
        $data = $block->model::where('id',$id)->first();
        return BlockTest::block($data);
    }

    public function page(){
        $row = Category::where('id','1')->first();
        $arJson = json_decode($row->source);
        $data = '';
        foreach ($arJson as $i){
            $data .= $this->block($i->url,$i->id);
        }

        return view('category-pages.mono',[
            'data' => $data
        ]);

    }
}
