<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductCategorys extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'lm_product_categorys';

    protected $fillable = ['category_name'];
}
