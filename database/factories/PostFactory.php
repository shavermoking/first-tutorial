<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{

    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(5),
            'content' => $this->faker->text,
            'image' => $this->faker->imageUrl,
            'likes' => $this->faker->numberBetween(1, 100),
            'is_published' => $this->faker->boolean(),
            'category_id' => Category::get()->random()->id
        ];
    }
}
