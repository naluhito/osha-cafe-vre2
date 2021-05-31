<?php

namespace App\Admin\Controllers;

use App\Models\Customer;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class CustomerController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '顧客';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Customer());

//        $grid->column('id', __('Id'));
//        $grid->column('token', __('Token'));
        $grid->column('mail', __('メール'));
//        $grid->column('password', __('Password'));
        $grid->column('name', __('氏名'));
        $grid->column('zip', __('郵便番号'));
        $grid->column('address1', __('都道府県'));
        $grid->column('address2', __('住所1'));
        $grid->column('address3', __('住所2'));
        $grid->column('tel', __('電話'));
        $grid->column('created_at', __('登録日'));
//        $grid->column('updated_at', __('Updated at'));

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
        $show = new Show(Customer::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('token', __('Token'));
        $show->field('mail', __('Mail'));
        $show->field('password', __('Password'));
        $show->field('name', __('Name'));
        $show->field('zip', __('Zip'));
        $show->field('address1', __('Address1'));
        $show->field('address2', __('Address2'));
        $show->field('address3', __('Address3'));
        $show->field('tel', __('Tel'));
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
        $form = new Form(new Customer());

        $form->text('token', __('Token'));
        $form->email('mail', __('Mail'));
        $form->password('password', __('Password'));
        $form->text('name', __('Name'));
        $form->text('zip', __('Zip'));
        $form->text('address1', __('Address1'));
        $form->text('address2', __('Address2'));
        $form->text('address3', __('Address3'));
        $form->text('tel', __('Tel'));

        return $form;
    }
}
