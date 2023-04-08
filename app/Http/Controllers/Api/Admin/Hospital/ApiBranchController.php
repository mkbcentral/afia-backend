<?php

namespace App\Http\Controllers\Api\Admin\Hospital;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Admin\Hospital\BranchRepository;
use App\Http\Resources\BranchResource;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiBranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $branchs = (new BranchRepository())->get();
            return BranchResource::collection($branchs);
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
            $branch = (new BranchRepository())->create($inputs);
            $response = [
                'success' => true,
                'message' => 'Branch added successfull',
                'branch' => $branch
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
            $branch = (new BranchRepository())->show($id);
            return new BranchResource($branch);
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
            'name' => 'required|string',
        ]);
        if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
        }
        try {
            $inputs['name'] = $request->name;
        $branch = (new BranchRepository())->update($id, $inputs);
        $response = [
            'success' => true,
            'message' => 'Branch updated successfull',
            'branch' => new BranchResource($branch)
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
            $branch = $this->show($id);
        if ( $branch->status == "ENABLE") {
            $response = [
                'success' => false,
                'message' => 'Action faild this hosp take data',
            ];
        } else {
            $status=(new branchRepository())->delete($id);
            $response = [
                'success' => $status,
                'message' => 'Branch deleted successfull',
            ];
        }
        return response()->json($response);
        } catch (Exception $ex) {
            return response()->json(['errors' => $ex->getMessage()]);
        }
    }

     //Change status
     public function changeStatus(int $id, Request $request)
     {
         try {
             (new BranchRepository())->changeStatus($id, $request->status);
             $response = [
                 'success' => true,
                 'message' => 'Status branch changed'
             ];
             return response()->json($response, 200);
         } catch (Exception $ex) {
             return response()->json(['errors' => $ex->getMessage()]);
         }
     }
}
