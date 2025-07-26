<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeasonTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $fruitSeasonMap = [
            'キウイ' => ['秋', '冬'],
            'ストロベリー' => ['春'],
            'オレンジ' => ['冬'],
            'スイカ' => ['夏'],
            'ピーチ' => ['夏'],
            'シャインマスカット' => ['夏', '秋'],
            'パイナップル' => ['春', '夏',],
            'ブドウ' => ['夏', '秋'],
            'バナナ' => ['夏'],
            'メロン' => ['春', '夏'],
         ];

         foreach ($fruitSeasonMap as $fruitName => $seasonNames) {
            $fruit = DB::table('products')->where('name', $fruitName)->first();

            foreach ($seasonNames as $seasonName) {
                  $season = DB::table('seasons')->where('name', $seasonName)->first();

                  DB::table('product_season')->insert([
                     'product_id' => $fruit->id,
                     'season_id' => $season->id,
                  ]);
            }

         }
      }
}
