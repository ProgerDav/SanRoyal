<?php

use Illuminate\Database\Seeder;
use App\Product;

class ProductTableSeed extends Seeder
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
        $img = "best_2.png";
        for($i = 1; $i < 5; $i++){
            $word = $arr[array_rand($arr)];
            Product::create([
                "name" => $word,
                "slug" => $word." ".$i.mt_rand(0, 10000),
                "image" => $img,
                "description" => $words,
                "bid" => 1,
                "scid" => 1
            ])->subcategory()->associate(1);
        }
    }
}
