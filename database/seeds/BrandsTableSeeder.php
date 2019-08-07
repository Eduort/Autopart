<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('brands')->insert([
            'id' => 1,
            'name' => 'Chevrolet'
        ]);

        DB::table('brands')->insert([
            'id' => 2,
            'name' => 'Ford'
        ]);

        DB::table('brands')->insert([
            'id' => 3,
            'name' => 'Nissan'
        ]);

        DB::table('brands')->insert([
            'id' => 4,
            'name' => 'Chevrolet'
        ]);

        DB::table('brands')->insert([
            'id' => 5,
            'name' => 'VolksWagen'
        ]);

        DB::table('brands')->insert([
            'id' => 6,
            'name' => 'Toyota'
        ]);

        DB::table('brands')->insert([
            'id' => 7,
            'name' => 'Honda'
        ]);

        DB::table('brands')->insert([
            'id' => 8,
            'name' => 'Mazda'
        ]);

        DB::table('brands')->insert([
            'id' => 9,
            'name' => 'Dodge'
        ]);

    }
}
