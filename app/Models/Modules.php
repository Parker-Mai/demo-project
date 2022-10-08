<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modules extends Model
{
    use HasFactory;

    protected $table = 'lm_modules';

    protected $fillable = ['module_display_name','module_name','module_model_name','module_controller_name','category_id'];
}
