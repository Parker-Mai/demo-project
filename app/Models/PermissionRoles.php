<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermissionRoles extends Model
{
    use HasFactory;

    protected $table = 'lm_permission_roles';

    protected $fillable = ['permission_id','role_id'];
}
