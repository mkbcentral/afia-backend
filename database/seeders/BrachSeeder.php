<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\Hospital;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrachSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hospital=Hospital::find(1);
        Branch::create(['name'=>'GOLF','hospital_id'=>$hospital->id]);
    }
}
