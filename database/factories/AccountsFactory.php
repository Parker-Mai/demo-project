<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Accounts>
 */
class AccountsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        
        return [
            'account_role' => rand(1,2),
            'account_name' => fake()->lexify('user_???'),
            'account_password' => password_hash('test1234',PASSWORD_DEFAULT),
            'account_realname' => fake()->name($gender = 'male'),
            'account_email' => fake()->email(),
            'account_phone' => fake()->tollFreePhoneNumber(),
            'account_cellphone' => fake()->phoneNumber(),
            'account_disabled' => 0
        ];
    }
}
