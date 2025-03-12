<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProductController extends Controller
{
    public function contact(Request $request){
        return [
            'status' => true,
            'message' => "mil gaya",
            'reque' => $request->all()
        ];
    }
    public function register(Request $request) {
        $err='';
        try {
            // return $request->all();
            if(User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'last_name' => $request->last_name,
                'password' => Hash::make($request->password)
            ])) {
                return [
                    'status' => true,
                    'token' => '',
                ];
            } 
        } catch (\Throwable $th) {
            $err = $th->getMessage();
        }
        return [
            'status' => false,
            'message' => $err
        ];
    }
   
    public function login(Request $request)
{
    try {
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return [
                'status' => false,
                'message' => 'Invalid Email'
            ];
        }

        // Direct comparison (Not Recommended)
        if ($user->password === $request->password) {
            return [
                'status' => true,
                'message' => 'Login Successful'
            ];
        } else {
            return [
                'status' => false,
                'message' => 'Invalid Password'
            ];
        }
    } catch (\Throwable $th) {
        return [
            'status' => false,
            'message' => 'Something went wrong'
        ];
    }
}

    public function trendingProducts() 
    {
        
        $products = DB::table('products')
        ->join('categories as c','c.id','products.category_id')
        ->select('products.*', DB::raw("c.name as category"))
        ->get();

        return response()->json([
            'status' => true,
            'data' => $products
        ,200]);
    }
}
