<?php

namespace App\Http\Repositories\Admin\Hospital;

use App\Models\Subscription;
use Illuminate\Support\Facades\Auth;

class SubscriptionRepository
{
    //Get all susbscription
    public function get()
    {
        $subscriptions = Subscription::orderBy('name', 'asc')->get();
        return $subscriptions;
    }
    //Create susbscription
    public function create(array $inputs): Subscription
    {
        $subscription = Subscription::create([
            'name' => $inputs['name'],
            'amount' => $inputs['amount'],
            'familly_quota' => $inputs['familly_quota'],
            'hospital_id' => $inputs['hospital_id'],
        ]);
        return $subscription;
    }
    //Show spécific user
    public function show(int $id): Subscription
    {
        $subscription = Subscription::find($id);
        return $subscription;
    }

    //Update Specific
    public function update(int $id, array $inputs): Subscription
    {
        $subscription = $this->show($id);
        $subscription->name = $inputs['name'];
        $subscription->amount = $inputs['amount'];
        $subscription->familly_quota = $inputs['familly_quota'];
        $subscription->update();
        return $subscription;
    }
    //Delete role
    public function delete(int $id): bool
    {
        $subscription = $this->show($id);
        if ($subscription->delete()) {
            $status = true;
        }
        return $status;
    }
    // Disable susbscription
    public function changeStatus(int $id, string $status): void
    {
        $subscription = $this->show($id);
        $subscription->status = $status;
        $subscription->update();
    }
}
