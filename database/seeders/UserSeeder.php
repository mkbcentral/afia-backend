<?php

namespace Database\Seeders;

use App\Models\Hospital;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hospital=Hospital::find(1);
        $role=Role::find(1);
        User::create([
            'name'=>'Admin',
            'email'=>'admin@shukra.app',
            'phone'=>'0971330007',
            'role'=>$role->id,
            'name'=>$hospital->id
        ]);
    }
}
