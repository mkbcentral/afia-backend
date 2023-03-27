<?php

namespace App\Http\Controllers\Api\Admin\Hospital;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Admin\Hospital\SubscriptionRepository;
use App\Http\Resources\SubscriptionResource;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiSubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $subscriptions = (new SubscriptionRepository())->get();
            return SubscriptionResource::collection($subscriptions);
        } catch (Exception $ex) {
            return response()->json(['errors' => $ex->getMessage()]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'amount' => 'required|numeric',
            'familly_quota' => 'required|numeric',
            'hospital_id' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        try {
            $inputs['name'] = $request->name;
            $inputs['amount'] = $request->amount;
            $inputs['familly_quota'] = $request->familly_quota;
            $inputs['hospital_id'] = $request->hospital_id;
            $subscription = (new SubscriptionRepository())->create($inputs);
            $response = [
                'success' => true,
                'message' => 'Branch added successfull',
                'subscription' => new SubscriptionResource($subscription)
            ];
            return response()->json($response, 200);
        } catch (Exception $ex) {
            return response()->json(['errors' => $ex->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $subscription = (new SubscriptionRepository())->show($id);
            return new SubscriptionResource($subscription);
        } catch (Exception $ex) {
            return response()->json(['errors' => $ex->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $inputs['name'] = $request->name;
        $inputs['amount'] = $request->amount;
        $inputs['familly_quota'] = $request->familly_quota;
        $subscription = (new SubscriptionRepository())->update($id, $inputs);
        $response = [
            'success' => true,
            'message' => 'Branch updated successfull',
            'subscription' => new SubscriptionResource($subscription)
        ];
        return response()->json($response, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $subscription = $this->show($id);
        if ( $subscription->status == "ENABLE" && $subscription->hospital==null) {
            $response = [
                'success' => false,
                'message' => 'Action faild this hosp take data',
            ];
        } else {
            $status=(new SubscriptionRepository())->delete($id);
            $response = [
                'success' => $status,
                'message' => 'Subscription deleted successfull',
            ];
        }
        return response()->json($response);
    }
     //Chang status
     public function changeStatus(int $id, Request $request)
     {
         try {
             (new SubscriptionRepository())->changeStatus($id, $request->status);
             $response = [
                 'success' => true,
                 'message' => 'Status subscription changed'
             ];
             return response()->json($response, 200);
         } catch (Exception $ex) {
             return response()->json(['errors' => $ex->getMessage()]);
         }
     }
}
