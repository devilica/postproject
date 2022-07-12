<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        $faker = \Faker\Factory::create();

        return [
            
            'user_id'=>\App\Models\User::factory(),
            'title'=>$faker->sentence,
            'post_image'=>$faker->imageUrl('900', '300'),
            'body'=>$faker->paragraph



        ];
    }
}
