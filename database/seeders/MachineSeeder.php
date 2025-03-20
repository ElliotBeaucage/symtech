<?php

namespace Database\Seeders;

use App\Models\Machine;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MachineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Machine::insert([
            "name" => 'Machine 1',
            "nombre_de_filtre" => 1,
            "filtre_id" => 1,
            "building_id" => 1
        ]);
        Machine::insert([
            "name" => 'Machine 2',
            "nombre_de_filtre" => 2,
            "filtre_id" => 2,
            "building_id" => 2
        ]);
        Machine::insert([
            "name" => 'Machine 3',
            "nombre_de_filtre" => 3,
            "filtre_id" => 3,
            "building_id" => 3
        ]);
        Machine::insert([
            "name" => 'Machine 4',
            "nombre_de_filtre" => 4,
            "filtre_id" => 4,
            "building_id" => 4
        ]);
        Machine::insert([
            "name" => 'Machine 5',
            "nombre_de_filtre" => 5,
            "filtre_id" => 5,
            "building_id" => 5
        ]);
    }
}
