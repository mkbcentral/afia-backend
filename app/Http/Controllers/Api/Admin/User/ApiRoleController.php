<?php

namespace App\Http\Controllers\Api\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Admin\User\RoleRepository;
use App\Http\Resources\RoleResource;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $roles = (new RoleRepository())->get();
            return RoleResource::collection($roles);
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
            (new RoleRepository())->create($inputs);
            $response = [
                'success' => true,
                'message' => 'Role added successfull'
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
            $role = (new RoleRepository())->show($id);
            return new RoleResource($role);
        } catch (Exception $ex) {
            return response()->json(['errors' => $ex->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $inputs['name'] = $request->name;
            (new RoleRepository())->update($id, $inputs);
            $response = [
                'success' => true,
                'message' => 'Role updated successfull'
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
        //
    }
    //Chang status
    public function changeStatus(int $id, Request $request)
    {
        try {
            (new RoleRepository())->changeStatus($id, $request->status);
            $response = [
                'success' => true,
                'message' => 'Status role changed'
            ];
            return response()->json($response, 200);
        } catch (Exception $ex) {
            return response()->json(['errors' => $ex->getMessage()]);
        }
    }
}
