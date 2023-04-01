<?php
namespace App\Http\Repositories\Admin\Others;
use App\Models\Commune;
use App\Models\Company;

class CompanyRepository{
    //Get all companies
    public function get()
    {
        $companies = Company::orderBy('name', 'asc')->get();
        return $companies;
    }
    //Create comany
    public function create(array $inputs): Company
    {
        $company = Company::create([
            'name' => $inputs['name'],
            'subscription_id' => $inputs['subscription_id'],
            'hospital_id' => $inputs['hospital_id'],
        ]);
        return $company;
    }
    //Show spécific company
    public function show(int $id): Company
    {
        $company = Company::find($id);
        return $company;
    }

    //Update Specific company
    public function update(int $id, array $inputs): Company
    {
        $company = $this->show($id);
        $company->name = $inputs['name'];
        $company->subscription_id = $inputs['subscription_id'];
        $company->update();
        return $company;
    }
    //Delete commune
    public function delete(int $id):bool{
        $company= $this->show($id);
        if ($company->delete()) {
             $status=true;
        }
        return $status;
     }
}
