<?php

namespace App\Admin\Controllers;

use App\Models\Order;
use App\Models\OrderBean;
use App\Models\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
Use Encore\Admin\Widgets\Table;

class Order2Controller extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Order';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Order());

//        $grid->disableExport();
//        $grid->disableRowSelector();
//        $grid->disableColumnSelector();
        $grid->disableCreateButton();

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
        $grid->column('name1', '発送先')->modal('発送先', function ($model) {
            $rows = [
                '〒' => $this->zip,
                '住所' => $this->pref.$this->address1.$this->address2.$this->address3,
                '氏名' => $this->name1.$this->name2,
                '電話番号' => $this->tel,
                'メールアドレス' => $this->mail
            ];
            return new Table([], $rows);
            $rows[] = [
                '電話番号',
                $this->tel
            ];
        });
        $grid->column('name2', ' ');
  
        $grid->column('zip', '郵便番号')->hide();
        $grid->column('pref', '住所')->display(function() {
            return $this->pref.$this->address1.$this->address2.$this->address3;
        })->hide();
        $grid->column('tel', '電話番号')->hide();
        $grid->column('mail', 'メール')->hide();

  
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
        $grid->column('shipped', '発送済')->editable('select', [false => '未', true => '済']);
        
        $grid->column('', '金額')->display(function (){
                return \number_format($this->amount + $this->shipping).'円';
        });

        $grid->column('created_at', __('購入日'))->display(function ($created_at){
            if(! strptime($created_at, '%Y-%m-%d')) {
                return null;
            }
            $result = new \DateTime($created_at);
            return $result->format('Y年m月d日');
        })->sortable();


        $grid->export(function ($export) {
            $export->filename('受注.csv');
//            $export->except(['user_id', 'paid', 'shipped', 'payment_kind']);
            $export->only(['order_no', 'name1', 'name2', 'pref', 'tel', 'mail']);
            $export->originalValue(['order_no', 'name1', 'name2', 'zip', 'address1', 'address2', 'address3', 'tel', 'mail']);
        });




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
        $show->field('user_id', __('User id'));
        $show->field('payment_kind', __('Payment kind'));
        $show->field('paid', __('Paid'));
        $show->field('shipped', __('Shipped'));
        $show->field('shipment_date', __('Shipment date'));
        $show->field('amount', __('Amount'));
        $show->field('tax', __('Tax'));
        $show->field('shipping', __('Shipping'));
        $show->field('zip', __('Zip'));
        $show->field('pref', __('Pref'));
        $show->field('address1', __('Address1'));
        $show->field('address2', __('Address2'));
        $show->field('address3', __('Address3'));
        $show->field('name1', __('Name1'));
        $show->field('name2', __('Name2'));
        $show->field('name3', __('Name3'));
        $show->field('name4', __('Name4'));
        $show->field('tel', __('Tel'));
        $show->field('mail', __('Mail'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('paid_date', __('Paid date'));
        $show->field('order_no', __('Order no'));
        $show->field('convenience', __('Convenience'));

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

        $form->number('user_id', __('User id'));
        $form->number('payment_kind', __('Payment kind'));
        $form->number('paid', __('Paid'));
        $form->switch('shipped', __('Shipped'));
        $form->date('shipment_date', __('Shipment date'))->default(date('Y-m-d'));
        $form->number('amount', __('Amount'));
        $form->number('tax', __('Tax'));
        $form->number('shipping', __('Shipping'));
        $form->text('zip', __('Zip'));
        $form->text('pref', __('Pref'));
        $form->text('address1', __('Address1'));
        $form->text('address2', __('Address2'));
        $form->text('address3', __('Address3'));
        $form->text('name1', __('Name1'));
        $form->text('name2', __('Name2'));
        $form->text('name3', __('Name3'));
        $form->text('name4', __('Name4'));
        $form->text('tel', __('Tel'));
        $form->email('mail', __('Mail'));
        $form->datetime('paid_date', __('Paid date'))->default(date('Y-m-d H:i:s'));
        $form->text('order_no', __('Order no'));
        $form->text('convenience', __('Convenience'));

        return $form;
    }
}
