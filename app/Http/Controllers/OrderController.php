<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
  

        public function allOrders()
        {
            $orders = DB::table('orders')
                ->join('users as u', 'u.id', '=', 'orders.user_id') // Join users table to get customer details
                ->join('products as p', 'p.id', '=', 'orders.product_id') // Join products table to get product details
                ->select(
                    'orders.*', 
                    DB::raw("u.name as customer_name"), 
                    DB::raw("p.name as product_name")
                )
                ->get();

            return $orders;
        }
    }
    


