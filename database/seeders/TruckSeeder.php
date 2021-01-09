<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TruckSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('trucks')->insert([
            'placa' => Str::random(10),
            'color' => Str::random(10),
            'modelo' => Str::random(10),
            'tipo_combustible' => Str::random(10),
            'rendimiento_estipulado' => Str::random(10),
            'photo_path' => Str::random(10),

        ]);
    }
}
