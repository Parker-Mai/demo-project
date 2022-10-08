<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductCategorys extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'lm_product_categorys';

    protected $fillable = ['category_name'];
}
