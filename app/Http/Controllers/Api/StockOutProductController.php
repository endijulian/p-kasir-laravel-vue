<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProductOutStock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockOutProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barangKeluar       = DB::table('stock_out_product')
                                ->join('stock_in_product', 'stock_out_product.stock_in_produck_id', 'stock_in_product.id')
                                ->select('stock_in_product.name as nameInBarang', 'stock_out_product.*')->get();

        return response()->json($barangKeluar);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'stock_in_produck_id'   => 'required',
            'qty'                   => 'required|numeric|'
        ],[
            'stock_in_produck_id.required' => 'Tidak Boleh Kosong!',
            'qty.required' => 'Tidak Boleh Kosong!',
            'qty.numeric' => 'Harus berupa angka!',
        ]);

        $stock_check = DB::table('stock_in_product')->where('id', $request->stock_in_produck_id)->first();

        if ($stock_check->qty < $request->qty ) {
            $success = false;
            $message = 'Stock Kosong';
        }else{
            $addBarangKeluar                          = array();
            $addBarangKeluar['stock_in_produck_id']   = $request->stock_in_produck_id;
            $addBarangKeluar['qty']                   = $request->qty;
            $addBarangKeluar['created_at']            = \Carbon\Carbon::now();

            DB::table('stock_out_product')->insert($addBarangKeluar);

            DB::table('stock_in_product')->where('id', $request->stock_in_produck_id)
                    ->update(['qty' => DB::raw('qty -' . $request->qty)]);

            $success = true;
            $message = 'Berhasil Create Stock Out!';
        }

          // response
          $response = [
            'success' => $success,
            'message' => $message,
        ];
        return response()->json($response);


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $show       = DB::table('stock_out_product')->where('id', $id)->first();

        return response()->json($show);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
}
