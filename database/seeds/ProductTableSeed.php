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
        $c = mt_rand(1, 30);        
       
        for($i = 1; $i < 50; $i++){
            $b = mt_rand(1, 10);
            $word = $arr[array_rand($arr)];
            $img = "new_".mt_rand(1, 10).".jpg";
            Product::create([
                "name" => "Product ".$i,
                "production" => "Китай",
                "warranty" => "12 мес.",
                "slug" => $word." ".$i.mt_rand(0, 10000),
                "image" => $img,
                "description" => $words,
                "bid" => $b,
                "scid" => $c
            ])->sub_categories()->associate($c)->brands()->associate($b);
        }

        for($i = 1; $i < 50; $i++){
            $b = mt_rand(1, 10);
            $c = mt_rand(1, 30);        
            $word = $arr[array_rand($arr)];
            $img = "new_".mt_rand(1, 10).".jpg";
            $img2 = "new_".mt_rand(1, 10).".jpg";
            $img3 = "new_".mt_rand(1, 10).".jpg";
            Product::create([
                "name" => "Product ".$i,
                "production" => "Китай",
                "warranty" => "12 мес.",
                "slug" => $word." ".$i.mt_rand(0, 10000),
                "image" => $img,
                "additional_images" => $img2.'-'.$img3,
                "description" => $words,
                "bid" => $b,
                "scid" => $c
            ])->sub_categories()->associate($c)->brands()->associate($b);
        }
    }
}
