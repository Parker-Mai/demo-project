<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Layouts extends Model
{
    use HasFactory;

    protected $table = 'lm_layouts';

    protected $fillable = ['layout_name','layout_root','layout_view_root'];
}
