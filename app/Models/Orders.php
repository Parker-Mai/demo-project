<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Orders extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'lm_orders';

    protected $fillable = [
        'order_uid',
        'member_id',
        'payment_method',
        'contact_phone',
        'order_address',
        'local_number',
        'shipping',
        'order_total',
        'api_trade_uid',
        'api_payment_no',
        'status'
    ];

    protected $casts = [
        'created_at'  => 'date:Y-m-d',
    ];
}
