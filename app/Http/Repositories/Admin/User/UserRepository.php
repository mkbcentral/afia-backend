<?php

namespace App\Http\Repositories\Admin\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
    //Get all User
    public function get()
    {
        $page=request('page_page');
        $users = User::query()
            ->orderBy('name', 'asc')
            ->where('hospital_id', auth()->user()->hospital->id)
            ->paginate($page);
        return $users;
    }
    //Create User
    public function create(array $inputs): User
    {
        $user = User::create([
            'name' => $inputs['name'],
            'email' => $inputs['email'],
            'phone' => $inputs['phone'],
            'password' => Hash::make($inputs['password']),
            'hospital_id' =>  auth()->user()->hospital->id,
            'role_id' => $inputs['role_id'],
            'branch_id' => auth()->user()->branch->id,
        ]);
        return $user;
    }
    //Show spécific user
    public function show(int $id): User
    {
        $user = User::find($id);
        return $user;
    }

    //Update Specific
    public function update(int $id, array $inputs): User
    {
        $user = $this->show($id);
        $user->name = $inputs['name'];
        $user->email = $inputs['email'];
        $user->phone = $inputs['phone'];
        $user->role_id = $inputs['role_id'];
        $user->update();
        return $user;
    }
    //Delete
    public function delete(int $id): bool
    {
        $user = $this->show($id);
        if ($user->delete()) {
            $status = true;
        }
        return $status;
    }
    // Disable user
    public function changeStatus(int $id, $status): void
    {
        $user = $this->show($id);
        $user->status = $status;
        $user->update();
    }

    //Search user
    public function search($query)
    {
        $users = User::where('name', 'like', "%{$query}%")
            ->where('hospital_id', auth()->user()->hospital->id)
            ->orderBy('name', 'ASC')->get();
        return $users;
    }
}
