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
//        $grid->model()->where('payment_kind', '=', '2');
        $grid->filter(function ($filter) {
            $filter->column(1/2, function ($filter) {
                $filter->disableIdFilter();
                $filter->startsWith('name','氏名'); 
            });
        });
        $grid->column('id', '注文番号')->display(function ($id){
            return sprintf('%05d', $id);
        });
        $grid->column('customer.name', '氏名');
        $grid->column('payment_kind', '支払方法')->display(function ($payment_kind) {
            if ($payment_kind == 1) {
                return "<span class='label label-warning'>Credit</span>";
            }
            if ($payment_kind == 2) {
                return "<span class='label label-warning'>Conveni</span>";
            }
            return "";
        });;
        $grid->column('paid', '支払済')->bool();
        $grid->column('', '金額')->display(function (){
                return \number_format($this->amount + $this->tax + $this->shipping);
        });


        $grid->column('print_image', __('Image'))->downloadable();
//        $grid->column('x', __('X'));
//        $grid->column('y', __('Y'));
//        $grid->column('w', __('W'));
//        $grid->column('h', __('H'));
        $grid->column('frame', __('Frame'));
        $grid->column('created_at', __('購入日'))->display(function ($created_at){
            if(! strptime($created_at, '%Y-%m-%d')) {
                return null;
            }
            $result = new \DateTime($created_at);
            return $result->format('Y年m月d日');
        });
//        $grid->column('created_at')->date('Y-m-d');
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
