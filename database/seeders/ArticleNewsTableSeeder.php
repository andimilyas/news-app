<?php

namespace Database\Seeders;

use App\Models\ArticleNews;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArticleNewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ArticleNews::factory(20)->create();
    }
}
