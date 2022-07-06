<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product    = Product::with('category')->get();

        return response()->json($product);
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
            'produck_name'  => 'required',
            'produck_code'  => 'required|unique:product',
            'category_id'   => 'required',
            'qty'           => 'required|numeric',
            'price'         => 'required|numeric',
        ]);

        $data               = new Product;
        $data->produck_name = $request->produck_name;
        $data->produck_code = $request->produck_code;
        $data->category_id  = $request->category_id;
        $data->qty          = $request->qty;
        $data->price        = $request->price;

        $data->save();

        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);

        return response()->json($product);
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
            'produck_name'  => 'required',
            'produck_code'  => 'required|unique:product,produck_code,' . $id,
            'category_id'   => 'required',
            'qty'           => 'required|numeric',
            'price'         => 'required|numeric',
        ]);

        $data                   = array();
        $data['produck_name']   = $request->produck_name;
        $data['produck_code']   = $request->produck_code;
        $data['category_id']    = $request->category_id;
        $data['qty']            = $request->qty;
        $data['price']          = $request->price;

        Product::where('id', $id)->update($data);
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
