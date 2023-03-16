<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Hospital;

class HospitalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Hospital::cretate([
            'name'=>'POLYCLINIQUE SHUKRANI',
            'email'=>'ps-shukra@shukra.app',
            'phone'=>'0971330007'
        ]);
    }
}
