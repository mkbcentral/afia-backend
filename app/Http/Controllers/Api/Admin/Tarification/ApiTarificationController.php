<?php

namespace App\Http\Controllers\Api\Admin\Tarification;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Admin\Tarification\TarificationRepository;
use App\Http\Requests\TarificationRequest;
use App\Http\Resources\TarificationResource;
use Exception;
use Illuminate\Http\Request;

class ApiTarificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $idCat=request('category_id');
            $consultations = (new TarificationRepository())->get($idCat);
            return TarificationResource::collection($consultations);
        } catch (Exception $ex) {
            return response()->json(['errors' => $ex->getMessage()]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TarificationRequest $request)
    {
        try {
            $inputs['name'] = $request->name;
            $inputs['abreviation'] = $request->abreviation;
            $inputs['price_private'] = $request->price_private;
            $inputs['price_subscribe'] = $request->price_subscribe;
            $inputs['category_tarification_id'] = $request->category_tarification_id;
            $tarification = (new TarificationRepository())->create($inputs);
            $response = [
                'success' => true,
                'message' => 'Tarification added successfull',
                'tarification' => new TarificationResource($tarification)
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
            $tarification = (new TarificationRepository())->show($id);
            $response = [
                'Tarification' => new TarificationResource($tarification)
            ];
            return response()->json($response, 200);
        } catch (Exception $ex) {
            return response()->json(['errors' => $ex->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TarificationRequest $request, string $id)
    {
        try {
            $inputs['name'] = $request->name;
            $inputs['abreviation'] = $request->abreviation;
            $inputs['price_private'] = $request->price_private;
            $inputs['price_subscribe'] = $request->price_subscribe;
            $inputs['category_tarification_id'] = $request->category_tarification_id;
            $tarification = (new TarificationRepository())->update($id, $inputs);
            $response = [
                'success' => true,
                'message' => 'Tarification updated successfull',
                'tarification' => new TarificationResource($tarification)
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
            $status = (new TarificationRepository())->delete($id);
            $response = [
                'success' => $status,
                'message' => 'Tarification deleted successfull',
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
            $tarification = (new TarificationRepository())->changeStatus($id);
            $response = [
                'success' => true,
                'tarification' => new TarificationResource($tarification),
                'message' => 'Status tarification changed',
            ];
            return response()->json($response);
        } catch (Exception $ex) {
            return response()->json(['errors' => $ex->getMessage()]);
        }
    }
}
