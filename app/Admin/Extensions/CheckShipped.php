<?php

namespace App\Admin\Extensions;

use Encore\Admin\Admin;

class CheckShipped
{
    protected $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    protected function script()
    {
        return <<<SCRIPT

$('.grid-send-row').on('click', function () {

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': LA.token
        },
        method: 'post',
        url: 'shipped_mail',
        contentType: "application/json",
        data: {
            _token:LA.token,
            id: $(this).data('id'),
        },
        success: function () {
            toastr.success('発送メールを送信しました');
        }
    });
});

SCRIPT;
    }

    protected function render()
    {
        Admin::script($this->script());

        return "<a class='btn btn-xs btn-success fa fa-envelope-o grid-send-row' data-id='{$this->id}'></a>";
    }

    public function __toString()
    {
        return $this->render();
    }
}
