<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SysSettings extends Model
{
    use HasFactory;

    protected $table = 'lm_sys_settings';

    protected $fillable = [];
}
