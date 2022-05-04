<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    function generateBarcodeNumber() {
        $number = mt_rand(1000000000, 9999999999); 
    
        // call the same function if the barcode exists already
        if (barcodeNumberExists($number)) {
            return generateBarcodeNumber();
        }
    
        // otherwise, it's valid and can be used
        return $number;
    }
    
    function barcodeNumberExists($number) {
        // query the database and return a boolean
        // for instance, it might look like this in Laravel
        return User::whereBarcodeNumber($number)->exists();
    }

    public function run()
    {
        for ($i=0;$i<100000;$i++){
        DB::table('users')->insert([
            'username'=> 'User '.(User::max('id')),
            'karma_score'=>rand(1000,5000),
            'image_id'=>$i+1
        ]);
    }
}
}
