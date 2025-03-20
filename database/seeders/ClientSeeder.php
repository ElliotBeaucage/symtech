<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Client::insert([
            'name' => "client 1",
        ]);
        Client::insert([
            'name' => "client 2",
        ]);
        Client::insert([
            'name' => "client 3",
        ]);
        Client::insert([
            'name' => "client 4",
        ]);
        Client::insert([
            'name' => "client 5",
        ]);
     
    }
}
