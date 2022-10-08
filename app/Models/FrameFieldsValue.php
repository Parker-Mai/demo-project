<?php

namespace App\Models;

use App\Models\FrameFieldsSetting;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FrameFieldsValue extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'lm_frame_fields_value';

    protected $fillable = ['article_id','setting_id','field_value'];

    public function fields_setting(){
        return $this->hasMany(FrameFieldsSetting::class,'id','setting_id');
    }
}
