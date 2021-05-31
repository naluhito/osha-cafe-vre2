<?php
namespace App\Admin\Extensions\Order;

use Closure;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Encore\Admin\Grid;
 
class OrderGrid extends Grid
{
 
    /**
     * View for grid to render.
     *
     * @var string
     */
    protected $view = 'admin.extensions.orders.table'; // ファイル名を変更します

    /**
     * Create a new grid instance.
     *
     * @param Eloquent $model
     * @param Closure  $builder
     */
    public function __construct(Eloquent $model, Closure $builder = null)
    {
        parent::__construct($model, $builder);
    }
}


