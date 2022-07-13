<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    public function RemoveCart($id)
    {
        DB::table('pos')->where('id', $id)->delete();

        return response()->json('Done Deleted!');
    }

    public function OrderDone(Request $request)
    {

        $request->validate([
            'customer_name' => 'required'
        ]);

        //get last record
        $record = Order::latest()->first();
        $expNum = explode('-', $record->invoice ?? '');

        //check first day in a year
        if ( date('l',strtotime(date('Y-01-01'))) ){
            $nextInvoiceNumber = date('Y').'-0001';
        } else {
            //increase 1 with last invoice number
            $nextInvoiceNumber = $expNum[0].'-'. $expNum[1]+1;
        }

        $data   = array();
        $data['customer_name']  = $request->customer_name;
        $data['qty']            = $request->qty;
        $data['total']          = $request->total;
        $data['invoice']        = $nextInvoiceNumber;
        $data['pay']            = $request->pay;
        $data['change']         = $request->change;
        $data['created_at']     = date('Y-m-d H:i:s');

        $order_id   = DB::table('orders')->insertGetId($data);
        $contents   = DB::table('pos')->get();
        $odata      = array();

        foreach ($contents as $content) {
            $odata['order_id']      = $order_id;
            $odata['product_id']    = $content->product_id;
            $odata['quantity']      = $content->product_quantity;
            $odata['price']         = $content->product_price;
            $odata['total']         = $content->sub_total;
            $odata['created_at']    = date('Y-m-d H:i:s');

            DB::table('order_details')->insert($odata);

            // DB::table('products')->where('id', $content->product_id)
            //     ->update(['product_quantity' => DB::raw('product_quantity -' . $content->product_quantity)]);
        }

        DB::table('pos')->delete();

    }


}
