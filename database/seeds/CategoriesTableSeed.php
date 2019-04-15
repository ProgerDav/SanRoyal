<?php

use Illuminate\Database\Seeder;
use App\Category;


class CategoriesTableSeed extends Seeder
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
        for($i = 0; $i < 10; $i++){
            $word = $arr[array_rand($arr)];
            $img = "featured_".mt_rand(1, 8).".png";
            Category::create([
                "name" => "Category ".$i,
                "slug" => $word.mt_rand(0, 1000),
                "image" => $img,
            ]);
        }   
    }
}
