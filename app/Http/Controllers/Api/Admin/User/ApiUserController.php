<?php

namespace App\Http\Controllers\Api\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Admin\User\UserRepository;
use App\Http\Resources\UserResource;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $users = (new UserRepository())->get();
            return UserResource::collection($users);
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
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|unique:users,phone',
            'role_id' => 'required|numeric',
            'hospital_id' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        try {
            $inputs['name'] = $request->name;
            $inputs['email'] = $request->email;
            $inputs['phone'] = $request->phone;
            $inputs['password'] = '123456';
            $inputs['role_id'] = $request->role_id;
            $inputs['hospital_id'] = $request->hospital_id;
            (new UserRepository())->create($inputs);
            $response = [
                'success' => true,
                'message' => 'User added successfull'
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
            $user = (new UserRepository())->show($id);
            return new UserResource($user);
        } catch (Exception $ex) {
            return response()->json(['errors' => $ex->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        try {
            $inputs['name'] = $request->name;
            $inputs['email'] = $request->email;
            $inputs['phone'] = $request->phone;
            $inputs['role_id'] = $request->role_id;
            $inputs['hospital_id'] = $request->hospital_id;
            (new UserRepository())->update($id, $inputs);
            $response = [
                'success' => true,
                'message' => 'User updated successfull'
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
            (new UserRepository())->changeStatus($id, $request->status);
            $response = [
                'success' => true,
                'message' => 'Status user changed'
            ];
            return response()->json($response, 200);
        } catch (Exception $ex) {
            return response()->json(['errors' => $ex->getMessage()]);
        }
    }
}
