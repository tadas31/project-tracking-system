<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Creates new user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validates user input.
        $validator = $this->validator($request);
        if ($validator->fails()) 
            return response()->json($validator->errors(), 400);

        // Checks if passwords match.
        if ($request->password != $request->confirm_password) 
            return response()->json(['error' => 'Passwords do not match.'], 400);

        // Creates new user.
        User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json(['message' => 'User created'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function validator($request) {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'email' => 'required|email|unique:users|unique:users,temp_email|unique:admins|unique:admins,temp_email',
            'password' => 'required|min:6',
            'confirm_password' => 'required|min:6',
        ]);

        return $validator;
    }
}
