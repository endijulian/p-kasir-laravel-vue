<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOutStock extends Model
{
    use HasFactory;

    protected $table        = 'stock_out_product';
    protected $fillable     = ['stock_in_product_id', 'qty'];


    public function barangMasuk()
    {
        return $this->belongsTo('App\Models\ProductInStock', 'stock_in_product_id', 'id');
    }
}
