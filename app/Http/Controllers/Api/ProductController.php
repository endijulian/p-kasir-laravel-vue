<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $product    = Product::with('category')->get();
        $product    = DB::table('product')
                        ->join('category', 'product.category_id', 'category.id')
                        ->select('product.*', 'category.category_name')
                        ->get();

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
            'image'         => 'required'
        ]);

        if ($request->image) {
            $position   = strpos($request->image, ';');
            $sub        = substr($request->image, 0, $position);
            $ext        = explode('/', $sub)[1];

            $name           = time() . "." . $ext;
            $img            = Image::make($request->image)->resize(150, 150);
            $upload_path    = 'backend/product/';
            $image_url      = $upload_path . $name;

            $img->save($image_url);

            $data               = new Product;
            $data->produck_name = $request->produck_name;
            $data->produck_code = $request->produck_code;
            $data->category_id  = $request->category_id;
            $data->qty          = $request->qty;
            $data->price        = $request->price;
            $data->image        = $image_url;

            $data->save();
        }

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
            'image'         => 'required'
        ]);

        $data                   = array();
        $data['produck_name']   = $request->produck_name;
        $data['produck_code']   = $request->produck_code;
        $data['category_id']    = $request->category_id;
        $data['qty']            = $request->qty;
        $data['price']          = $request->price;
        $image                  = $request->newimage;

        if ($image) {
            $position   = strpos($image, ';');
            $sub        = substr($image, 0, $position);
            $ext        = explode('/', $sub)[1];

            $name           = time() . "." . $ext;
            $img            = Image::make($image)->resize(150, 150);
            $upload_path    = 'backend/product/';
            $image_url      = $upload_path . $name;

            $success        = $img->save($image_url);

            if ($success) {
                $data['image']  = $image_url;
                $img            = Product::where('id', $id)->first();
                $image_path     = $img->image;
                $done           = unlink($image_path);
                $user           =  Product::where('id', $id)->update($data);
            }
        } else {
            $oldPhoto       = $request->image;
            $data['image']  = $oldPhoto;
            $user           =  Product::where('id', $id)->update($data);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product    = DB::table('product')->where('id', $id)->first();
        $image_url  = $product->image;

        if ($image_url) {
            unlink($image_url);
            DB::table('product')->where('id', $id)->delete();
        } else {
            DB::table('product')->where('id', $id)->delete();
        }

        return response()->json($product);
    }
}
