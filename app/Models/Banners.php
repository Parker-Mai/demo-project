<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Banners extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'lm_banners';

    protected $fillable = [
        'title',
        'link',
        'banner_img'
    ];
}
