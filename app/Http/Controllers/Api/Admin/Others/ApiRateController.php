<?php

namespace App\Http\Controllers\Api\Admin\Others;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Admin\Others\RateRepository;
use App\Http\Resources\RateResource;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiRateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $rates = RateResource::collection((new RateRepository())->get());
            return $rates;
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
            'amount' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        try {
            $inputs['amount'] = $request->amount;
            $rate = (new RateRepository())->create($inputs);
            $response = [
                'success' => true,
                'message' => 'Rate added successfull',
                'rate' => new RateResource($rate)
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
            $rate = (new RateRepository())->show($id);
            return new RateResource($rate);
        } catch (Exception $ex) {
            return response()->json(['errors' => $ex->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        try {
            $inputs['amount'] = $request->amount;
            $rate = (new RateRepository())->update($id, $inputs);
            $response = [
                'success' => true,
                'message' => 'Rate updated successfull',
                'rate' => new  RateResource($rate)
            ];
            return response()->json($response, 200);
        } catch (Exception $ex) {
            return response()->json(['errors' => $ex->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $rate = $this->show($id);
            $status = (new RateRepository())->delete($id);
            $response = [
                'success' => $status,
                'message' => 'Rate deleted successfull',
            ];
            return response()->json($response);
        } catch (Exception $ex) {
            return response()->json(['errors' => $ex->getMessage()]);
        }
    }
    //Change Status
    public function changeStatus(int $id)
    {
        try {
            $rate = (new RateRepository())->changeStatus($id);
            $response = [
                'success' => true,
                'rate'=>new RateResource($rate),
                'message' => 'Status rate changed',
            ];
            return response()->json($response);
        } catch (Exception $ex) {
            return response()->json(['errors' => $ex->getMessage()]);
        }
    }
    //Get current rate
    public function getCurrentRate()
    {
        try {
            $rate = (new RateRepository())->getCurrentRate();
            $response = [
                'success' => true,
                'rate'=>new RateResource($rate),
            ];
            return response()->json($response);
        } catch (Exception $ex) {
            return response()->json(['errors' => $ex->getMessage()]);
        }
    }


}
