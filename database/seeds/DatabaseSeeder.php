<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(PostsTableSeed::class);
        // $this->call(CategoriesTableSeed::class);
        // $this->call(BrandsTableSeed::class);
        // $this->call(SubCategoriesTableSeed::class);
        $this->call(ProductTableSeed::class);
        // $this->call(CertificatesTableSeed::class);
    }
}
