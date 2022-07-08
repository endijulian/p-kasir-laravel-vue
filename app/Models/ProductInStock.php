<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductInStock extends Model
{
    use HasFactory;

    protected $table        = 'stock_in_product';
    protected $fillable     = ['name', 'qty'];
}
