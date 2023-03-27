<?php

namespace App\Http\Repositories\Admin\Hospital;

use App\Models\Branch;
use Illuminate\Support\Facades\Auth;

class BranchRepository
{
    //Get all branch
    public function get()
    {
        $branchs = Branch::orderBy('name', 'asc')->get();
        return $branchs;
    }
    //Create branch
    public function create(array $inputs): Branch
    {
        $branch = Branch::create([
            'name' => $inputs['name'],
            'hospital_id' => $inputs['hospital_id'],
        ]);
        return $branch;
    }
    //Show spécific user
    public function show(int $id): Branch
    {
        $branch = Branch::find($id);
        return $branch;
    }

    //Update Specific
    public function update(int $id, array $inputs): Branch
    {
        $branch = $this->show($id);
        $branch->name = $inputs['name'];
        $branch->update();
        return $branch;
    }
    //Delete role
    public function delete(int $id):bool{
        $branch= $this->show($id);
        if ($branch->delete()) {
             $status=true;
        }
        return $status;
     }
    // Disable branch
    public function changeStatus(int $id, string $status): void
    {
        $branch = $this->show($id);
        $branch->status = $status;
        $branch->update();
    }
}
