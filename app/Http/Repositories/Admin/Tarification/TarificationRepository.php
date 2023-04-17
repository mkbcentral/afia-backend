<?php

namespace App\Http\Repositories\Admin\Tarification;

use App\Models\Tarification;

class TarificationRepository
{
    //Get tarifications by category
    public function get($catId)
    {
        return Tarification::where('hospital_id', auth()->user()->hospital->id)
            ->where('category_tarification_id',$catId)
            ->get();
    }
    //Create new tarification
    public function create(array $inputs): Tarification
    {
        $tarification = Tarification::create([
            'name' => $inputs['name'],
            'abreviation' => $inputs['abreviation'],
            'price_private' => $inputs['price_private'],
            'price_subscribe' => $inputs['price_subscribe'],
            'hospital_id' => auth()->user()->hospital->id,
            'category_tarification_id' => $inputs['category_tarification_id'],
        ]);
        return $tarification;
    }
    public function show(int $id){
        return Tarification::find($id);
    }
    //Update specific tarification
    public function update(int $id,array $inputs){
        $tarification=$this->show($id);
        $tarification->name=$inputs['name'];
        $tarification->abreviation=$inputs['abreviation'];
        $tarification->price_private=$inputs['price_private'];
        $tarification->price_subscribe=$inputs['price_subscribe'];
        $tarification->category_tarification_id=$inputs['category_tarification_id'];
        $tarification->update();
    }
    //Delete specific tarification
    public function delete($id): bool
    {
        $tarification = $this->show($id);
        $status = false;
        if ($tarification->delete()) {
            $status = true;
        }
        return $status;
    }
     //Change status of specific tarification
     public function changeStatus($id): Tarification
     {
         $tarification = $this->show($id);
         if ($tarification->status == true) {
             $tarification->status = false;
         } else {
             $tarification->status = true;
         }
         $tarification->update();
         return $tarification;
     }


}
