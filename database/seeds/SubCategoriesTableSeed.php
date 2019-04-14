<?php

use Illuminate\Database\Seeder;
use App\SubCategory;


class SubCategoriesTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $words = "Lorem ipsum, dolor sit amet, consectetur adipisicing, elit Fugiat dolore, excepturi harum, fugit, quis placeat, ab Non maiores, Vel natus consequuntur, harum accusantium, numquam, architecto, facilis ut officia, perspiciatis, dignissimos";
        $arr = explode(", ", $words);
        $img = "featured_".mt_rand(1, 8).".png";
        for($i = 0; $i < 30; $i++){
            $r = mt_rand(1, 10);
            $word = $arr[array_rand($arr)];
            SubCategory::create([
                "name" => $word,
                "slug" => $word.mt_rand(0, 1000),
                "image" => $img,
                "cid" => $r
            ])->categories()->associate($r);
        } 
    }
}
