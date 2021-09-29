<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Models\Basket;

class TestController extends Controller
{
    public function test() {
        $id = 15;
        $filename = 'test.jpeg';

        $basket = new Basket();
        $b = $basket->find($id);
        $print_image = $this->_create_print_image($filename, $b);
        return $print_image->response();
    }

    private function _create_print_image($filename, $basket) {
        $photo = \Image::make($basket->photo_uri);
        $path = storage_path('app/frame/'.$basket->frame);
        $frame = \Image::make($path);

        $scale =  $frame->width() / $basket->image_frameWidth;

        $c = \Image::canvas(floor($photo->width() * $scale), floor($photo->height() * $scale), '#ffffff');

        $w = $photo->width() * $basket->image_scale;
        $w *= $scale;
        $photo->widen(floor($w));

        $px = $basket->image_diffx * $basket->image_scale;
        $py = $basket->image_diffy * $basket->image_scale;
        $px *= $scale;
        $py *= $scale;
        $c->insert($photo, 'top-left', floor($px), floor($py));

        $fx = ($c->width() / 2) - ($frame->width() / 2);
        $fy = ($c->height() / 2) - ($frame->height() / 2);
        $c->insert($frame, 'top-left', floor($fx), floor($fy));

        $c->crop($frame->width(), $frame->height(), floor($fx), floor($fy));

        $save_path = storage_path('app/upimages/'.$filename);
        $c->save($save_path);
        return $c;
    }

    private function _create_print_image2($filename, $basket) {
        $photo = \Image::make($basket->photo_uri);
        $path = '/Users/nalu/Dev/htdocs/oshicafe_app/public/frame/';
        $frame = \Image::make($path.$basket->frame);

        $c = \Image::canvas($photo->width(), $photo->height(), '#ffffff');

        $w = $photo->width() * $basket->image_scale;
        $photo->widen(floor($w));

        $px = $basket->image_diffx * $basket->image_scale;
        $py = $basket->image_diffy * $basket->image_scale;
        $c->insert($photo, 'top-left', floor($px), floor($py));

        $frame->widen(floor($basket->image_frameWidth));
        $fx = ($c->width() / 2) - ($basket->image_frameWidth / 2);
        $fy = ($c->height() / 2) - ($basket->image_frameHeight / 2);
        $c->insert($frame, 'top-left', floor($fx), floor($fy));

        $c->crop(floor($basket->image_frameWidth), floor($basket->image_frameHeight), floor($fx), floor($fy));

//        $save_path = storage_path('app/upimages/'.$filename);
//        $photo->save($save_path);
        return $c;
    }

}
