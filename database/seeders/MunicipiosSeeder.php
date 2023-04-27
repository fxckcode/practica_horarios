<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Municipios;

class MunicipiosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Municipios::insert([
            'id' => 1,
            'nombre_mpio' => 'Pitalito',
            'departamento' => 'Huila'
        ]);
    }
}
