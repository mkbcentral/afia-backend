<?php

namespace App\Http\Repositories\Admin\Tarification;

use App\Models\Consultation;

class ConsultationRepository
{
    //Get all consultations
    public function get()
    {
        $consultations = Consultation::where('hospital_id', auth()->user()->hospital->id)
            ->where('status', true)
            ->get();
        return $consultations;
    }
    // Create new consultation
    public function create(array $inputs): Consultation
    {
        $consultation = Consultation::create([
            'name' => $inputs['name'],
            'price_private' => $inputs['price_private'],
            'price_subscribe' => $inputs['price_subscribe'],
            'hospital_id' => auth()->user()->hospital->id,
        ]);
        return $consultation;
    }
    //Show spécific consultation
    public function show(int $id): Consultation
    {
        return Consultation::find($id);
    }
    //Update specific consultation
    public function update(int $id, array $inputs): Consultation
    {
        $consultation = $this->show($id);
        $consultation->name = $inputs['name'];
        $consultation->price_private = $inputs['price_private'];
        $consultation->price_subscribe = $inputs['price_subscribe'];
        $consultation->update();
        return $consultation;
    }
    //Delete specific consultation
    public function delete($id): bool
    {
        $consultation = $this->show($id);
        $status = false;
        if ($consultation->delete()) {
            $status = true;
        }
        return $status;
    }
    //Change status of specific consultation
    public function changeStatus($id): Consultation
    {
        $consultation = $this->show($id);
        if ($consultation->status == true) {
            $consultation->status = false;
        } else {
            $consultation->status = true;
        }
        $consultation->update();
        return $consultation;
    }
}
