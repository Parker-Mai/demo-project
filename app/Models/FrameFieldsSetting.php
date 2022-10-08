<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FrameFieldsSetting extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'lm_frame_fields_setting';

    protected $fillable = ['frame_id','field_display_name','field_name','field_type','field_option'];


    // public function getFieldOptionAttribute($value){ //Accessor
        
    //     $out = explode(",",$value);

    //     return $out;

    // }
}
