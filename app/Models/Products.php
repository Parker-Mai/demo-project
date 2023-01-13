<?php

namespace App\Models;

use App\Models\ProductCategorys;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Products extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'lm_products';

    protected $fillable = [
        'user_id',
        'product_name',
        'product_main_category',
        'product_category',
        'product_quantity',
        'product_price',
        'product_img',
        'product_content',
        'product_description',
        'product_specification',
        'is_show',
        'is_popular',
    ];

    public function scopeFilter($query,array $filters){

        if(!empty(request('tags'))){
            $query->where('product_category','like','%@#'.request('tags').'@#%');
        }

        if(!empty(request('type'))){
            $query->where('product_category','like','%@#'.request('type').'@#%');
        }

        if(!empty(request('keyword'))){
            $query->where('product_name','like','%'.request('keyword').'%')
                  ->orWhere('product_description','like','%'.request('keyword').'%')
                  ->orWhere('product_category','like','%'.request('keyword').'%');
        }

    }


    // public function getProductMainCategoryAttribute($value){ //針對主商品分類的 Accessor
        
    //     switch($value){
    //         case 1: return '經典巧克力'; break;
    //         case 2: return '經典蛋糕'; break;
    //         case 3: return '彌月蛋糕'; break;
    //     }

    // }

    public function getProductCategoryAttribute($value){ //針對商品分類的 Accessor
        
        if(empty($value)){
            return "";
        }


        $product_category_arr = str_replace('@#',',',$value);

        $product_category_arr = array_values(array_filter($product_category_arr = explode(",",$product_category_arr)));

        // $product_category_arr = json_decode($value,1);

        // $product_category_list = [];

        foreach($product_category_arr as $category_id){

            $category = ProductCategorys::find($category_id); //抓商品分類

            if(!$category){
                break;
            }

            $product_category_list[$category->id] = $category->category_name;
        }
        
        return $product_category_list;

    }


    // public function getProductDescriptionAttribute($value){

    //     return preg_replace("/<br.*>/U", "\r\n", $value);

    // }

    // public function getProductSpecificationAttribute($value){

    //     return preg_replace("/<br.*>/U", "\r\n", $value);

    // }
}
