<?php

namespace App\Models;

use App\Models\Layouts;
use App\Models\SitemapFrames;
use App\Models\FrameFieldsSetting;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SitemapFrames extends Model
{
    use HasFactory;

    protected $table = 'lm_sitemap_frames';

    protected $fillable = [
        'frame_display_name',
        'frame_name',
        'is_external_link',
        'link_url',
        'frame_type',
        'type_content_layout_id',
        'type_list_layout_id',
        'use_module_model',
        'module_id',
        'is_index',
        'is_disabled',
        'parent_frame_id'
    ];


    public function childs(){
        return $this->hasMany(SitemapFrames::class,'parent_frame_id','id');
    }

    public function list_layouts(){
        return $this->hasMany(Layouts::class,'id','type_list_layout_id');
    }

    public function content_layouts(){
        return $this->hasMany(Layouts::class,'id','type_content_layout_id');
    }

    public function frame_fields_setting(){
        return $this->hasMany(FrameFieldsSetting::class,'frame_id','id');
    }

}
