<?php

namespace Database\Factories;

use App\Models\ArticleNews;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;
use App\Models\Author;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ArticleNews>
 */
class ArticleNewsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $category = Category::pluck('id')->toArray();
        $author = Author::pluck('id')->toArray();
        $is_featured = ArticleNews::pluck('is_featured')->toArray();

        return [
            //
            'name' => fake()->sentence(10),
            'content' => fake()->paragraph(5),
            'slug' => fake()->unique()->slug(),
            'thumbnail' => fake()->imageUrl(),
            'category_id' => fake()->randomElement($category),
            'author_id' => fake()->randomElement($author),
            'is_featured' => fake()->randomElement($is_featured)
        ];
    }
}
