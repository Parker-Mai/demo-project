<?php

namespace App\Models;

use App\Models\SitemapFrames;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Articles extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'lm_articles';

    protected $fillable = ['frame_id','data_title','is_show'];

    public function frame_fields_value(){
        return $this->hasMany(FrameFieldsValue::class,'article_id','id');
    }

    public function scopeFilter($query,array $filters){
        

        if(!empty(request('frame_id'))){
            $query->where('frame_id','=',request('frame_id'));
        }


    }

    public function frame_data(){
        return $this->hasMany(SitemapFrames::class,'frame_id','id')->withDefault();
    }
}
