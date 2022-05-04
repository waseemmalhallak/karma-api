<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0;$i<100000;$i++){
        DB::table('images')->insert([
            'url' => 'https://placeimg.com/100/100/any?' . $i
        ]);
    }
    }
}
