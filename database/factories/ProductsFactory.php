<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        $unit = ['個','顆','組','串','包'];
        $product_category = [];

        for($i=1;$i<=rand(1,6);$i++){
            
            $num = rand(1,6);

            while(in_array($num,$product_category)){
                $num = rand(1,6);
            }

            $product_category[] = $num;

        }

        $product_category = json_encode($product_category,JSON_UNESCAPED_UNICODE);

        return [];
    }
}
