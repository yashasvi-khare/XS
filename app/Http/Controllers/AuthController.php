<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name'      => 'required|string|max:200',
            'last_name' => 'required|string|max:200',
            'email'     => 'required|string|max:200|unique:users',
            'phone'     => 'required|string|max:200|unique:users',
            'password'  => 'required|string'
        ]);

        try {
        if ($validator->fails())
        {
            return response()->json($validator->errors());
        }

        $user = new User();
        $user->name = $request->name;
        $user->last_name= $request->last_name;
        $user->password = Hash::make($request->password);
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->save();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status'  =>  true,
            'message' => 'Registered Successfully!',
            'data'          => $user,
            'access_token'  => $token,
            'token_type'    => 'Bearer'
        ]);
        } catch (\Throwable $th) {
            logger($th->getMessage());
           return [$th->getMessage()];
        }

    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'     => 'required|string|max:255',
            'password'  => 'required|string'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(),400);
        }
        $credentials = $request->only('email', 'password');

        if(Auth::attempt($credentials)) {
            $user = User::where('email', $request->email )->firstOrFail();
            $token = $user->createToken('auth_token')->plainTextToken;
            return response()->json([
                'status' => true,
                'message'       => 'Login success',
                'access_token'  => $token,
                'token_type'    => 'Bearer',
                'user'          => $user,
            ]);
        }

        return response()->json([
            'status' => false,
            'message'       => 'Incorrect email or password'
        ]);

    }
    public function logout()
    {
        if(!auth()->user()->emp_type) { // shouldn't be a logged-in employee
            // Auth::user()->tokens()->delete();
            User::whereId(Auth::user()->id)->update([
                'cID'=> null,
                'cName'=> null
            ]);
        }
        return response()->json([
            'status'  => true,
            'message' => 'Logout successful'
        ]);
    }

    public function updateProfile(Request $request)
    {
        $user = User::whereId($request->user_id);
        if($user->exists()) {
            $user->update([
                'email'     => $request->email,
                'name'      => $request->name,
                'username'  => $request->username
            ]);
            return ['status'=> true, 'user'=> $user->first() ];
        } else {
            $user = Employee::whereId($request->user_id);
            if($user->exists()) {
                $user->update([
                    'login_id' => $request->login_id,
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                ]);
            }
            return ['status'=> true, 'user'=> $user->first() ];
        }
    }


    public function user(Request $request)
    {
        return response()->json($request->user());
    }
}
