<?php

namespace App\Http\Controllers\Api\Admin\Others;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Admin\Others\CurrencyRepository;
use App\Http\Repositories\Admin\Others\RateRepository;
use App\Http\Resources\CurrencyResource;
use App\Http\Resources\RateResource;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiCurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $curruncies = (new CurrencyRepository())->get();
            return CurrencyResource::collection($curruncies);
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
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        try {
            $inputs['name'] = $request->name;
            $inputs['hospital_id'] = auth()->user()->hospital->id;
            $currency = (new CurrencyRepository())->create($inputs);
            $response = [
                'success' => true,
                'message' => 'Currecny added successfull',
                'currency' => new CurrencyResource($currency)
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
            $currency = (new CurrencyRepository())->show($id);
            return new CurrencyResource($currency);
        } catch (Exception $ex) {
            return response()->json(['errors' => $ex->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        try {
            $inputs['name'] = $request->name;
            $currency = (new CurrencyRepository())->update($id, $inputs);
            $response = [
                'success' => true,
                'message' => 'Currency updated successfull',
                'currency' => new CurrencyResource($currency)
            ];
            return response()->json($response, 200);
        } catch (Exception $ex) {
            return response()->json(['errors' => $ex->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        try {
            $service=$this->show($id);
            $status=(new CurrencyRepository())->delete($id);
                $response = [
                    'success' => $status,
                    'message' => 'Currency deleted successfull',
                ];
            return response()->json($response);
        } catch (Exception $ex) {
            return response()->json(['errors' => $ex->getMessage()]);
        }
    }

}
