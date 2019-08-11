<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 'Seeding database' es el proceso en el cual un conjunto inicial de datos
     * es provisto a la base de datos cuando está siendo instalada. 
     * Este es un proceso automatizado que es ejecutado en la configuración
     * inicial de la aplicación.  
     *  Para Laravel, se ejecuta en la línea de comandos poniendo: 
     * 
     * -------------   php artisan migrate:fresh --seed   -------------
     * @return void
     */
    public function run()
    {
        /** 
         * Llenamos la tabla 'brands' con algunos campos, 
         * utilizamos comandos DDL (Data Manipulation Language)
         * para insertar algunos registros.   
         */
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

        DB::table('brands')->insert([
            'id' => 10,
            'name' => 'Seat'
        ]);

    }
}
