<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProductInStock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class StockInProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barangMasuk    = ProductInStock::all();

        return response()->json($barangMasuk);
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
            'name' => 'required',
            'qty'  => 'required|numeric'
        ]
        ,[
            'name.required' => 'Tidak Boleh Kosong!',
            'qty.required' => 'Tidak Boleh Kosong!',
            'qty.numeric' => 'Harus berupa angka!',
        ]);

        $barangMasuk            = new ProductInStock;
        $barangMasuk->name      = $request->name;
        $barangMasuk->qty       = $request->qty;
        $barangMasuk->date      = date('Y-m-d');
        $barangMasuk->save();

        return response()->json($barangMasuk);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $barangMasuk    = ProductInStock::where('id', $id)->first();

        return response()->json($barangMasuk);
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
        $request->validate([
            'name'  => 'required',
            'qty'   => 'required|numeric'
        ],[
            'name.required' => 'Tidak Boleh Kosong!',
            'qty.required' => 'Tidak Boleh Kosong!',
            'qty.numeric' => 'Harus berupa angka!',
        ]);

        $update         = array();
        $update['name'] = $request->name;
        $update['qty']  = $request->qty;

        $updateBarang   = ProductInStock::where('id', $id)->update($update);

        return response()->json($updateBarang);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('stock_in_product')->where('id', $id)->delete();
    }
}
