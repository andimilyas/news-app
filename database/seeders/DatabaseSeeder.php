<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\ArticleNews;
use App\Models\Author;
use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        if (Author::count() == 0) {
            $this->call(AuthorsTableSeeder::class);
        }

        if (Category::count() == 0) {
            $this->call(CategoriesTableSeeder::class);
        }

        if (ArticleNews::count() == 0) {
            $this->call(ArticleNewsTableSeeder::class);
        }
    }
}
