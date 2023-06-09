<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\Hospital;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hospital=Hospital::find(1);
        $role=Role::find(1);
        $branch=Branch::find(1);
        User::create([
            'name'=>'Admin',
            'email'=>'admin@shukra.app',
            'phone'=>'0971330007',
            'password'=>Hash::make('123456'),
            'role_id'=>$role->id,
            'hospital_id'=>$hospital->id,
            'branch_id'=>$branch->id
        ]);
    }
}
