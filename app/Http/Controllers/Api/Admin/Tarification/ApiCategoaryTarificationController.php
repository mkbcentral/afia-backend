<?php

namespace App\Http\Controllers\Api\Admin\Tarification;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Admin\Tarification\CategoryTarificationRepository;
use App\Http\Requests\CategoryTarificationRequest;
use App\Http\Resources\CategoryTarificationResource;
use Exception;
use Illuminate\Http\Request;

class ApiCategoaryTarificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $tarifications = (new CategoryTarificationRepository())->get();
            return CategoryTarificationResource::collection($tarifications);
        } catch (Exception $ex) {
            return response()->json(['errors' => $ex->getMessage()]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryTarificationRequest $request)
    {
        try {
            $inputs['name'] = $request->name;
            $category = (new CategoryTarificationRepository())->create($inputs);
            $response = [
                'success' => true,
                'message' => 'Category added successfull',
                'category' => new CategoryTarificationResource($category)
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
            $category = (new CategoryTarificationRepository())->show($id);
            $response = [
                'category' => new CategoryTarificationResource($category)
            ];
            return response()->json($response, 200);
        } catch (Exception $ex) {
            return response()->json(['errors' => $ex->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryTarificationRequest $request, int $id)
    {
        try {
            $inputs['name'] = $request->name;
            $category = (new CategoryTarificationRepository())->update($id,$inputs);
            $response = [
                'success' => true,
                'message' => 'Category updated successfull',
                'category' => new CategoryTarificationResource($category)
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
            $status=(new CategoryTarificationRepository())->delete($id);
            $response = [
                'success' => $status,
                'message' => 'Tarification deleted successfull',
            ];
            return response()->json($response);
        } catch (Exception $ex) {
            return response()->json(['errors' => $ex->getMessage()]);
        }
    }

    public function getFirstRecord()
    {
        try {
            $category=(new CategoryTarificationRepository())->first();
            $response = [
                'success' => true,
                'category'=>$category
            ];
            return response()->json($response);
        } catch (Exception $ex) {
            return response()->json(['errors' => $ex->getMessage()]);
        }
    }
}
