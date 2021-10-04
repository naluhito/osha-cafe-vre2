<?php

namespace App\Admin\Controllers;

use App\Models\Order;
use App\Models\OrderBean;
use App\Models\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Illuminate\Support\Facades\Log;
//use App\Admin\Extensions\Order\OrderGrid as Grid;
Use Encore\Admin\Widgets\Table;

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
        $grid->disableExport();
        $grid->disableRowSelector();
        $grid->disableColumnSelector();
        $grid->model()->orderBy('id', 'desc');
        $grid->filter(function ($filter) {
            $filter->column(1/2, function ($filter) {
                $filter->disableIdFilter();
                $filter->between('created_at', '購入日')->datetime();
                $filter->equal('paid', '支払')->checkbox(['0' => '未', '1' => '済']);
                $filter->equal('shipped', '発送')->checkbox(['0' => '未', '1' => '済']);
            });
        });
        $grid->column('order_no', '注文番号')->sortable()->modal('注文内容', function ($model) {

            $header = ['印刷画像', '豆'];
            $images = $model->items()->get()->map(function ($item) {
                return $item;
            });

            $rows = [];
            foreach ($images as $image) {
                $beans = OrderBean::with('bean')->where('id', $image['id'])->get();
                $buffer = '
                <table class="kounyuhin table table-bordered tbl-2column mt-0">
                <tbody>';
                foreach ($beans as $bean) {
                    if ($bean->kind == 0) {
                        $type = 'ドリップバッグタイプ';
                    } else {
                        $type = 'コーヒーバッグタイプ';
                    }
                    $buffer = $buffer.'
                        <tr><th class="w-md-25 bg-768-gray">'.$type.' '.$bean->bean->name.'</th>
                        <th class="w-md-25 text-right">'.$bean->quantity.'</th></tr>';
                }
                $buffer = $buffer.
                '
                </tbody>
                </table>
                ';

                $img_buffer = '
                <p>
	                <a href="/print_images/'.$image['image'].'" download">画像を保存</a>
                </p>
                <p>
                <img src="/print_images/'.$image['image'].'" width="100" height="100">
                </p>
                <p>'.$image['paper'].'</p>';
                $row = [
                    $img_buffer, $buffer
                ];
                $rows[] = $row;
            }
            return new Table($header, $rows);
        });
        $grid->column('user_id', '会員名')->display(function($user_id) {
            if ($user_id == null) {
                return 'guest';
            }
            $user = User::find($user_id);
            return $user->name;
        });
        $grid->column('name1', '発送先')->display(function () {
            return $this->name1.$this->name2;
        });
        $grid->column('payment_kind', '支払方法')->display(function ($payment_kind) {
            if ($payment_kind == 0) {
                return "<span class='label label-primary'>Credit</span>";
            }
            if ($payment_kind == 1) {
                return "<span class='label label-warning'>Conveni</span>";
            }
            return "";
        });;
        $grid->column('paid', '支払済')->bool();
//        $grid->column('shipped', '発送済')->bool();
        $grid->column('shipped', '発送済')->editable('select', [false => '未', true => '済']);
        
        $grid->column('', '金額')->display(function (){
                return \number_format($this->amount + $this->tax + $this->shipping).'円';
        });

        $grid->column('created_at', __('購入日'))->display(function ($created_at){
            if(! strptime($created_at, '%Y-%m-%d')) {
                return null;
            }
            $result = new \DateTime($created_at);
            return $result->format('Y年m月d日');
        })->sortable();

        $grid->actions(function ($actions) {
              $actions->append('<a href=""><i class="fa fa-eye"></i></a>');
        });
  
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
