<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Members extends Authenticatable
{
    use HasFactory;
    use SoftDeletes;
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'lm_members';
    
    protected $fillable = [
        'login_type',
        'api_id',
        'member_name',
        'member_password',
        'member_email',
        'member_realname',
        'member_gender',
        'member_phone',
        'member_birth',
        'is_disabled',
        'avatar',
        'token'
    ];

    public function getAuthPassword(){
        return  $this->member_password;
    }

    protected $hidden = [
        'member_password',
        'remember_token',
        'google_token',
    ];

    public function setMemberPasswordAttribute($value){ //Mutator
        
        $this->attributes['member_password'] = password_hash($value,PASSWORD_DEFAULT);

    }
}
