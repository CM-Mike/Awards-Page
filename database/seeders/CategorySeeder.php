<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   public function run()
{
    $categories = [
        ['name' => 'Tech', 'slug' => 'tech'],
        ['name' => 'Music', 'slug' => 'music'],
        ['name' => 'Influencer', 'slug' => 'influencer'],
        ['name' => 'Tech Below 30', 'slug' => 'tech-below-30'],
        ['name' => 'Arts', 'slug' => 'arts'],
        ['name' => 'Innovation', 'slug' => 'innovation'],
    ];

    foreach ($categories as $cat) {
        Category::create($cat);
    }
}
}
