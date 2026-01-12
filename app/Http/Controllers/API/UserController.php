<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return User::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        //
        $user_id = $request->user_id;
        return User::findOrFail($user_id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

     /**
     * Update the specified resource in storage.
     */
    public function update_user(Request $request): JsonResponse
    {
        //
        // Get current user
        $userId = $request->user_id;
        $user = User::findOrFail($userId);

        // Validate the data submitted by user
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            // 'email' => 'email|max:225|'. Rule::unique('users')->ignore($user->id),
            'phone' => 'required|max:225|',
        ]);

        // if fails redirects back with errors
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());  
            //return response()->json([$success, 'success'=>'User was updated successfully.']);     
        }
    

        // Make sure you've got the Page model
        if($user) {
            $user->name = $request->name;
            $user->phone = $request->phone;
            $user->email = $request->email;
            $user->save();
        }

        $success['id'] =  $user->id;
        $success['token'] =  $user->createToken('Ship2Me')->plainTextToken;
        $success['name'] =  $user->name;
        $success['phone'] =  $user->phone;
        $success['email'] =  $user->email;
   
        //return $this->response($success, 'User updated successfully.');
        return response()->json([$success, 'success'=>'User was updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
