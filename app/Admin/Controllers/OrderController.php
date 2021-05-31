<?php

namespace App\Admin\Controllers;

use App\Models\Order;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
//use Encore\Admin\Grid;
use App\Admin\Extensions\Order\OrderGrid as Grid;

use Encore\Admin\Show;

class OrderController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '受注';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Order());

//        $grid->column('id', __('Id'));
        $grid->column('customer.name', __('氏名'));
        $grid->column('payment_kind', __('支払方法'))->filter();
        $grid->column('paid', __('Paid'));
        $grid->column('amount', __('Amount'));
        $grid->column('tax', __('Tax'));
        $grid->column('shipping', __('Shipping'));
        $grid->column('image', __('Image'));
//        $grid->column('x', __('X'));
//        $grid->column('y', __('Y'));
//        $grid->column('w', __('W'));
//        $grid->column('h', __('H'));
        $grid->column('frame', __('Frame'));
        $grid->column('created_at', __('Created at'));
 //       $grid->column('updated_at', __('Updated at'));

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
        $show = new Show(Order::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('customer_id', __('Customer id'));
        $show->field('payment_kind', __('Payment kind'));
        $show->field('paid', __('Paid'));
        $show->field('amount', __('Amount'));
        $show->field('tax', __('Tax'));
        $show->field('shipping', __('Shipping'));
        $show->field('image', __('Image'));
        $show->field('x', __('X'));
        $show->field('y', __('Y'));
        $show->field('w', __('W'));
        $show->field('h', __('H'));
        $show->field('frame', __('Frame'));
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
        $form = new Form(new Order());

        $form->number('customer_id', __('Customer id'));
        $form->number('payment_kind', __('Payment kind'));
        $form->number('paid', __('Paid'));
        $form->number('amount', __('Amount'));
        $form->number('tax', __('Tax'));
        $form->number('shipping', __('Shipping'));
        $form->image('image', __('Image'));
        $form->number('x', __('X'));
        $form->number('y', __('Y'));
        $form->number('w', __('W'));
        $form->number('h', __('H'));
        $form->text('frame', __('Frame'));

        return $form;
    }
}
