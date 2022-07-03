<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductInOut extends Model
{
    use HasFactory;

    protected $table        = 'product_in_out';
    protected $fillable     = ['product_id', 'qty', 'status_id'];
}
