<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Accounts extends Authenticatable
{
    use HasFactory;
    use SoftDeletes;
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'lm_accounts';
    
    protected $fillable = [
        'account_role',
        'account_name',
        'account_password',
        'account_realname',
        'account_email',
        'account_phone',
        'account_cellphone',
        'account_disabled',
        'account_photo'
    ];

    protected $hidden = [
        'account_password',
        'remember_token',
    ];

    public function getAuthPassword(){
        return  $this->account_password;
    }

    public function scopeFilter($query,array $filters){
        
        $query->where('account_name','like','%'.request('keyword').'%')
                ->orWhere('account_realname','like','%'.request('keyword').'%')
                ->orWhere('account_email','like','%'.request('keyword').'%');

    }

    public function setAccountPasswordAttribute($value){ //Mutator
        
        $this->attributes['account_password'] = password_hash($value,PASSWORD_DEFAULT);

    }

    public function getAccountDisabledAttribute($value){ //Accessor
        
        if($value == 0){
            $out = '啟用';
        }else{
            $out = '停用';
        }

        return $out;

    }

    
}
