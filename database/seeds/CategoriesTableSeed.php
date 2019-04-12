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
        $img = "featured_2.png";
        // for($i = 0; $i < 10; $i++){
            $word = $arr[array_rand($arr)];
            Category::create([
                "name" => $word,
                "slug" => "testcat8".mt_rand(0, 10000),
                "image" => $img,
            ]);
        // }   
    }
}
