<?php

namespace App\Admin\Controllers;

use App\Models\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class UserController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'User';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new User());

        $grid->disableExport();
        $grid->disableRowSelector();
        $grid->disableColumnSelector();
        $grid->disableCreateButton();

	$grid->model()->take(5);
        $grid->filter(function ($filter) {
            $filter->column(1/2, function ($filter) {
                $filter->disableIdFilter();
                $filter->like('name', '氏名');
                $filter->between('created_at', '購入日')->datetime();
            });
        });
        $grid->column('name', __('氏名'));
        $grid->column('name3', __('フリガナ'))->display(function () {
            return $this->name3.$this->name4;
        });
        $grid->column('email', __('メール'));
        $grid->column('zip', __('〒'));
        $grid->column('pref', __('住所'))->display(function () {
            return $this->pref.$this->address1.$this->address2.$this->address3;
        });
        $grid->column('tel', __('電話番号'));
        $grid->column('created_at', __('登録日'));

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
        $show = new Show(User::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('email', __('Email'));
        $show->field('email_verified_at', __('Email verified at'));
        $show->field('password', __('Password'));
        $show->field('remember_token', __('Remember token'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('name1', __('Name1'));
        $show->field('name2', __('Name2'));
        $show->field('name3', __('Name3'));
        $show->field('name4', __('Name4'));
        $show->field('zip', __('Zip'));
        $show->field('pref', __('Pref'));
        $show->field('address1', __('Address1'));
        $show->field('address2', __('Address2'));
        $show->field('address3', __('Address3'));
        $show->field('tel', __('Tel'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new User());

        $form->text('name', __('Name'));
        $form->email('email', __('Email'));
        $form->datetime('email_verified_at', __('Email verified at'))->default(date('Y-m-d H:i:s'));
        $form->password('password', __('Password'));
        $form->text('remember_token', __('Remember token'));
        $form->text('name1', __('Name1'));
        $form->text('name2', __('Name2'));
        $form->text('name3', __('Name3'));
        $form->text('name4', __('Name4'));
        $form->text('zip', __('Zip'));
        $form->text('pref', __('Pref'));
        $form->text('address1', __('Address1'));
        $form->text('address2', __('Address2'));
        $form->text('address3', __('Address3'));
        $form->text('tel', __('Tel'));

        return $form;
    }
}
