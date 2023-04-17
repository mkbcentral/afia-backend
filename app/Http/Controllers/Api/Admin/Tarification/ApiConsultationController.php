<?php

namespace App\Http\Controllers\Api\Admin\Tarification;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Admin\Tarification\ConsultationRepository;
use App\Http\Requests\ConsultationRequest;
use App\Http\Resources\ConsultationResource;
use Exception;
use Illuminate\Http\Request;

class ApiConsultationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $consultations = (new ConsultationRepository())->get();
            return ConsultationResource::collection($consultations);
        } catch (Exception $ex) {
            return response()->json(['errors' => $ex->getMessage()]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ConsultationRequest $request)
    {
        try {
            $inputs['name'] = $request->name;
            $inputs['price_private'] = $request->price_private;
            $inputs['price_subscribe'] = $request->price_subscribe;
            $consultation = (new ConsultationRepository())->create($inputs);
            $response = [
                'success' => true,
                'message' => 'consultation added successfull',
                'consultation' => new ConsultationResource($consultation)
            ];
            return response()->json($response, 200);
        } catch (Exception $ex) {
            return response()->json(['errors' => $ex->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        try {
            $consultation = (new ConsultationRepository())->show($id);
            $response = [
                'consultation' => new ConsultationResource($consultation)
            ];
            return response()->json($response, 200);
        } catch (Exception $ex) {
            return response()->json(['errors' => $ex->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ConsultationRequest $request, string $id)
    {
        try {
            $inputs['name'] = $request->name;
            $inputs['price_private'] = $request->price_private;
            $inputs['price_subscribe'] = $request->price_subscribe;
            $consultation = (new ConsultationRepository())->update($id, $inputs);
            $response = [
                'success' => true,
                'message' => 'consultation updated successfull',
                'consultation' => new ConsultationResource($consultation)
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
            $status = (new ConsultationRepository())->delete($id);
            $response = [
                'success' => $status,
                'message' => 'Consultation deleted successfull',
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
            $consultation = (new ConsultationRepository())->changeStatus($id);
            $response = [
                'success' => true,
                'consultation' => new ConsultationResource($consultation),
                'message' => 'Status consultation changed',
            ];
            return response()->json($response);
        } catch (Exception $ex) {
            return response()->json(['errors' => $ex->getMessage()]);
        }
    }
}
