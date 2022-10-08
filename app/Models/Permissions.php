<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permissions extends Model
{
    use HasFactory;

    protected $table = 'lm_permissions';

    protected $fillable = ['permission_name','permission_display_name','module_id'];
}
