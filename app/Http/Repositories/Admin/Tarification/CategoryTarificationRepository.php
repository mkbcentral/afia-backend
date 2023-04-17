<?php

namespace App\Http\Repositories\Admin\Tarification;

use App\Models\CategoryTarification;

class CategoryTarificationRepository
{
    //Get all categories
    public function get()
    {
        return CategoryTarification::where('hospital_id', auth()->user()->hospital->id)->get();
    }
    //Create new category
    public function create(array $inputs): CategoryTarification
    {
        $category = CategoryTarification::create([
            'name' => $inputs['name'],
            'hospital_id' => auth()->user()->hospital->id
        ]);
        return $category;
    }
    //Show specific category
    public function show(int $id): CategoryTarification
    {
        return CategoryTarification::find($id);
    }
    //Update specific category
    public function update(int $id, array $inputs): CategoryTarification
    {
        $category = $this->show($id);
        $category->name = $inputs['name'];
        $category->update();
        return $category;
    }
    //Delete specific category
    public function delete($id): bool
    {
        $category = $this->show($id);
        $status = false;
        if ($category->tarifications->isEmpty()) {
            $category->delete();
            $status = true;
        } else {
            $status = false;
        }
        return $status;
    }
}
