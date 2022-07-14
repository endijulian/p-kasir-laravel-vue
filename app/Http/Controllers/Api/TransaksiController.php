<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
        $orders     = Order::orderBy('id', 'desc')->get();

        return response()->json($orders);
    }

    public function detailTransaksi($id)
    {
        $order_Details = OrderDetail::with(['order', 'product'])->where('order_id', $id)->get();

        return response()->json($order_Details);
    }

    public function deleteTransaksi($id)
    {
        $delete = Order::findOrFail($id);
        $delete->delete();

        $deleteDetail = OrderDetail::where('order_id', $id);
        $deleteDetail->delete();
    }

    public function printTransaksi($id)
    {
        $order_Details = OrderDetail::with(['order', 'product'])->where('order_id', $id)->get();

        return view('print.printTransaksi', compact('order_Details'));
    }
}
