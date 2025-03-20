<?php

namespace Database\Seeders;

use App\Models\Building;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BuildingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Building::insert([
            'adresse' => "building 1",
            "client_id" => 1
        ]);
        Building::insert([
            'adresse' => "building 2",
            "client_id" => 2
        ]);
        Building::insert([
            'adresse' => "building 3",
            "client_id" => 3
        ]);
        Building::insert([
            'adresse' => "building 4",
            "client_id" => 4
        ]);
        Building::insert([
            'adresse' => "building 5",
            "client_id" => 5
        ]);
    }
}
