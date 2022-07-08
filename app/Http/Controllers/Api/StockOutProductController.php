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
        $barangKeluar       = ProductOutStock::with('barangMasuk')->get();

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
            'stock_in_product_id'   => 'required',
            'qty'                   => 'required|numeric'
        ]);

        $addBarangKeluar                        = new ProductOutStock;
        $addBarangKeluar->stock_in_product_id   = $request->stock_in_product_id;
        $addBarangKeluar->qty                   = $request->qty;
        $addBarangKeluar->save();

        DB::table('stock_in_product')->where('id', $request->stock_in_product_id)
                ->update(['qty' => DB::raw('qty -' . $request->stock_in_product_id)]);

        return response()->json($addBarangKeluar);
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
