<?php

namespace App\Http\Controllers\Api\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Admin\User\UserRepository;
use App\Http\Requests\UserResquest;
use App\Http\Resources\UserResource;
use Exception;
use Illuminate\Http\Request;

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
    public function store(UserResquest $request)
    {
        try {
            $inputs['name'] = $request->name;
            $inputs['email'] = $request->email;
            $inputs['phone'] = $request->phone;
            $inputs['password'] = '123456';
            $inputs['role_id'] = $request->role_id;
            $user=(new UserRepository())->create($inputs);
            $response = [
                'success' => true,
                'message' => 'User added successfull',
                'user'=>new UserResource($user)
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
    public function update(UserResquest $request, int $id)
    {
        try {
            $inputs['name'] = $request->name;
            $inputs['email'] = $request->email;
            $inputs['phone'] = $request->phone;
            $inputs['role_id'] = $request->role_id;

            $user= (new UserRepository())->update($id, $inputs);
            $response = [
                'success' => true,
                'message' => 'User updated successfull',
                'user'=>new UserResource($user)
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
        $user=$this->show($id);
        if ($user->status=="ENABLE") {
            $response = [
                'success' => false,
                'message' => 'Action faild this user take data',
            ];
        } else {
            $status=(new UserRepository())->delete($id);
            $response = [
                'success' => $status,
                'message' => 'user$user deleted successfull',
            ];
        }
        return response()->json($response);
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

    //Search user
    public function searchUser(){
        $searchQuery=request('query');
        try {
            $users= (new UserRepository())->search($searchQuery);
            return UserResource::collection($users);
        } catch (Exception $ex) {
            return response()->json(['errors' => $ex->getMessage()]);
        }
    }


}
