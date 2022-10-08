<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SysSettings extends Model
{
    use HasFactory;

    protected $table = 'lm_sys_settings';

    protected $fillable = [
        'sys_name',
        'sys_logo',
        'sys_start_date',
        'sys_end_date',
        'sys_deny_ip',
        'sys_api_id',
        'sys_api_hashkey',
        'sys_api_hashiv',
        'sys_api_ctc_id',
        'sys_api_ctc_hashkey',
        'sys_api_ctc_hashiv'
    ];
}
