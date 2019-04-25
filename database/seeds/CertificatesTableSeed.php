<?php

use Illuminate\Database\Seeder;
use App\Certificate;

class CertificatesTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Certificate::create([
            'title' => 'Hansen',
            'image' => 'hansen.jpg'
        ]);
    }
}
