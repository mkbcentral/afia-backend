<?php
namespace App\Http\Repositories\Admin\User;

use App\Models\Role;

class RoleRepository{
    //Get all User
    public function get()
    {
        $roles = Role::orderBy('name', 'asc')->get();
        return $roles;
    }
    //Create Role
    public function create(array $inputs): Role
    {
        $role = Role::create([
            'name' => $inputs['name'],
        ]);
        return $role;
    }
    //Show spécific Role
    public function show(int $id): Role
    {
        $role = Role::find($id);
        return $role;
    }

    //Update Specific
    public function update(int $id, array $inputs): Role
    {
        $role = $this->show($id);
        $role->name = $inputs['name'];
        $role->update();
        return $role;
    }
    //Delete role
    public function delete(int $id):bool{
        $role= $this->show($id);
        if ($role->delete()) {
             $status=true;
        }
        return $status;
     }
    // Disable Role
    public function changeStatus(int $id, string $status): void
    {
        $role = $this->show($id);
        $role->status = $status;
        $role->update();
    }
}
