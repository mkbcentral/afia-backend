<?php

namespace Database\Seeders;

use App\Models\Hospital;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hospital=Hospital::find(1);
        Role::create(['name'=>'Admin','hospital_id'=>$hospital->id]);
    }
}
