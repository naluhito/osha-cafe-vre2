<?php

namespace App\Admin\Controllers;

use App\Models\Bean;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class BeanController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Bean';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Bean());

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('features1', __('Features1'));
        $grid->column('features2', __('Features2'));
        $grid->column('features3', __('Features3'));
        $grid->column('note', __('Note'));
        $grid->column('image', __('Image'));
        $grid->column('disp', __('Disp'));
        $grid->column('kind', __('Kind'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

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
        $show = new Show(Bean::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('features1', __('Features1'));
        $show->field('features2', __('Features2'));
        $show->field('features3', __('Features3'));
        $show->field('note', __('Note'));
        $show->field('image', __('Image'));
        $show->field('disp', __('Disp'));
        $show->field('kind', __('Kind'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Bean());

        $form->text('name', __('Name'));
        $form->text('features1', __('Features1'));
        $form->text('features2', __('Features2'));
        $form->text('features3', __('Features3'));
        $form->textarea('note', __('Note'));
        $form->text('image', __('Image'));
        $form->switch('disp', __('Disp'))->default(1);
        $form->number('kind', __('Kind'));

        return $form;
    }
}
