<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BeanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('beans')->insert([
        [
            'name' => 'ブラジル産完熟ベリー「スペシャルSc」',
            'features1' => '香り',
            'features2' => '甘味',
            'features3' => 'まろやか',
            'note' => 'ベリー系のトロピカルな香りと甘味が特徴',
            'image' => 'beans_img/item-beens1-1.png',
            'disp' => '1',
            'kind' => '0',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ],
        [
            'name' => 'タンザニア産レイヨウの風「コンゴーニ・エステート」',
            'features1' => 'コク',
            'features2' => '甘み',
            'features3' => 'ビターチョコ',
            'note' => 'チョコレートのような甘味とカラメルの香味が口元に長く留まる心地よさが持ち味。',
            'image' => 'beans_img/item-beens1-2.png',
            'disp' => '1',
            'kind' => '0',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ],
        [
            'name' => 'インドネシア産モカ・ジャバの進化系「ジャワ・アラビカ」',
            'features1' => '甘み',
            'features2' => 'バランス',
            'features3' => '香り',
            'note' => 'フローラルでミルクチョコレートのような甘みのあるクリーンな珈琲。',
            'image' => 'beans_img/item-beens1-3.png',
            'disp' => '1',
            'kind' => '0',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ],
        [
            'name' => 'タコロンビア産コロンビア原種「サン・アグスティンORIGIN」',
            'features1' => '甘み',
            'features2' => 'バランス',
            'features3' => '香り',
            'note' => '甘みコク香りとも優れ、中南米らしい飲み易さも合わせ持つ珈琲。',
            'image' => 'beans_img/item-beens1-4.png',
            'disp' => '1',
            'kind' => '0',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ],
        [
            'name' => 'タンザニア産最高グレード「タンザニアAA」',
            'features1' => 'コク',
            'features2' => 'ビターチョコ',
            'features3' => 'キレ',
            'note' => '薫り高く酸味の効いたコーヒーでキレがありアフリカを代表する味。',
            'image' => 'beans_img/item-beens1-5.png',
            'disp' => '1',
            'kind' => '0',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ],
                            

        [
            'name' => 'ブラジル産完熟ベリー「スペシャルSc」',
            'features1' => '香り',
            'features2' => '甘味',
            'features3' => 'まろやか',
            'note' => 'ベリー系のトロピカルな香りと甘味が特徴',
            'image' => 'beans_img/item-beens2-1.png',
            'disp' => '1',
            'kind' => '1',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ],
        [
            'name' => 'タンザニア産レイヨウの風「コンゴーニ・エステート」',
            'features1' => 'コク',
            'features2' => '甘み',
            'features3' => 'ビターチョコ',
            'note' => 'チョコレートのような甘味とカラメルの香味が口元に長く留まる心地よさが持ち味。',
            'image' => 'beans_img/item-beens2-2.png',
            'disp' => '1',
            'kind' => '1',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ],
        [
            'name' => 'インドネシア産モカ・ジャバの進化系「ジャワ・アラビカ」',
            'features1' => '甘み',
            'features2' => 'バランス',
            'features3' => '香り',
            'note' => 'フローラルでミルクチョコレートのような甘みのあるクリーンな珈琲。',
            'image' => 'beans_img/item-beens2-3.png',
            'disp' => '1',
            'kind' => '1',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ],
        [
            'name' => 'タコロンビア産コロンビア原種「サン・アグスティンORIGIN」',
            'features1' => '甘み',
            'features2' => 'バランス',
            'features3' => '香り',
            'note' => '甘みコク香りとも優れ、中南米らしい飲み易さも合わせ持つ珈琲。',
            'image' => 'beans_img/item-beens2-4.png',
            'disp' => '1',
            'kind' => '1',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ],
        [
            'name' => 'タンザニア産最高グレード「タンザニアAA」',
            'features1' => 'コク',
            'features2' => 'ビターチョコ',
            'features3' => 'キレ',
            'note' => '薫り高く酸味の効いたコーヒーでキレがありアフリカを代表する味。',
            'image' => 'beans_img/item-beens2-5.png',
            'disp' => '1',
            'kind' => '1',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ],

    ]);    
    }
}
