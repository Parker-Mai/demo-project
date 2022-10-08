<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberAddresses extends Model
{
    use HasFactory;

    protected $table = 'lm_member_addresses';

    protected $fillable = [
        'member_id',
        'zipcode',
        'city',
        'area',
        'address',
        'addressee',
    ];
}
