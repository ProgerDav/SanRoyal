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
        $img = "featured_2.png";
        // for($i = 0; $i < 10; $i++){
            $word = $arr[array_rand($arr)];
            SubCategory::create([
                "name" => $word,
                "slug" => "testsubcat5".mt_rand(0, 10000),
                "image" => $img,
                "cid" => 1
            ])->category()->associate(1);
        // } 
    }
}
