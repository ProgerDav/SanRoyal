<?php

use Illuminate\Database\Seeder;
use App\Brand;

class BrandsTableSeed extends Seeder
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
            $img = "brands_".mt_rand(1, 5).".jpg";
            Brand::create([
                "name" => "Brand ".$i,
                "slug" => $word.mt_rand(0, 1000),
                "image" => $img,
                "description" => $words,
            ]);
        }  
    }
}
