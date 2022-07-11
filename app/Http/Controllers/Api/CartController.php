<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function AddToCart(Request $request, $id)
    {
        $product    = DB::table('product')->where('id', $id)->first();
        $check      = DB::table('pos')->where('product_id', $id)->first();


        if ($check) {
            DB::table('pos')->where('product_id', $id)->increment('product_quantity');
            $product    = DB::table('pos')->where('product_id', $id)->first();

            $subtotal   = $product->product_quantity * $product->product_price;
            DB::table('pos')->where('product_id', $id)->update(['sub_total' => $subtotal]);
        } else {
            $data = array();
            $data['product_id']         = $id;
            $data['product_name']       = $product->produck_name;
            $data['product_quantity']   = 1;
            $data['product_price']      = $product->price;
            $data['sub_total']          = $product->price;
            $data['created_at']         = \Carbon\Carbon::now();

            DB::table('pos')->insert($data);
        }
    }

    public function CartProduct()
    {
        $cart = DB::table('pos')->get();

        return response()->json($cart);
    }


    public function increment($id)
    {
        $quantity   = DB::table('pos')->where('id', $id)->increment('product_quantity');
        $product    = DB::table('pos')->where('id', $id)->first();

        $subtotal   = $product->product_quantity * $product->product_price;
        DB::table('pos')->where('id', $id)->update(['sub_total' => $subtotal]);

        return response()->json('Done');
    }

    public function decrement($id)
    {
        $quantity   = DB::table('pos')->where('id', $id)->decrement('product_quantity');
        $product    = DB::table('pos')->where('id', $id)->first();

        $subtotal   = $product->product_quantity * $product->product_price;
        DB::table('pos')->where('id', $id)->update(['sub_total' => $subtotal]);

        return response()->json('Done');
    }


}
