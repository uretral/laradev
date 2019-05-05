<?php

namespace App\Admin\Controllers;

//use App\Menu;
//use App\Models\Cats;
//use App\Http\Controllers\Controller;
//use App\Models\Category;
//use Encore\Admin\Controllers\HasResourceActions;
//use Encore\Admin\Form;
//use Encore\Admin\Grid;
//use Encore\Admin\Layout\Content;
//use Encore\Admin\Show;
//use Encore\Admin\Controllers\ModelForm;
use App\Http\Controllers\Controller;
use App\Models\Block;
use App\Models\Cats;
use Encore\Admin\Form;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Tree;
class CatsController extends Controller
{
//    use HasResourceActions;
    use ModelForm;

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
//    public function index(Content $content)
//    {
//        return $content
//            ->header('Index')
//            ->description('description')
//            ->body($this->grid());
//    }

    public function index()
    {
        return Admin::content(function (Content $content) {
            $content->header('Categories');
            $content->body(Cats::tree(function ($tree) {
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
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Cats);

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
        $show = new Show(Cats::findOrFail($id));

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
        $form = new Form(new Cats);
        $form->display('ID');
        $form->alias('alias');
        $form->select('parent');
        $form->text('name','Название')->attribute('rel','alias');
        $form->image('intro_img','Иконка');
        $form->textarea('intro');
//        $form->textarea('intro','Интро текст');
        $form->sortable('intro')->options(Block::all()->pluck('name','url'));


        return $form;
    }
}
