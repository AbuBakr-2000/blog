<?php

namespace Database\Factories;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;


class PostFactory extends Factory
{
    public function definition()
    {
        return [
            'user_id' => rand(1,2),
            'category_id' => rand(1,5),
            'title' => fake()->sentence(3),
            'short_content' => fake()->sentence(5),
            'content' => fake()->paragraph(20),
        ];
    }
}
