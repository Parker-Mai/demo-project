<?php

namespace App\Models;

use App\Models\Products;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductCarts extends Model
{
    use HasFactory;

    protected $table = 'lm_product_carts';

    protected $fillable = ['member_id','product_id','quantity','total','order_id'];

}
