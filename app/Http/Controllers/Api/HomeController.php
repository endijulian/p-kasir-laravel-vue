<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function stockToday()
    {
        $date = date('Y-m-d');

        $sell = DB::table('stock_in_product')->whereDate('created_at', $date)->sum('qty');

        return response()->json($sell);
    }

    public function sellToday()
    {
        $date = date('Y-m-d');

        $todaySell  = DB::table('orders')->whereDate('created_at', $date)->sum('total');

        return response()->json($todaySell);
    }

    public function todayProduct()
    {
        $date = date('Y-m-d');
        $todaySell  = DB::table('order_details')->whereDate('created_at', $date)->count('product_id');

        return response()->json($todaySell);
    }
}
