<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySubcategorySeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['name' => 'Lifestyle', 'slug' => 'lifestyle', 'icon' => '✨', 'subs' => ['Lifestyle Creator of the Year', 'Travel & Culture Storyteller', 'Home & Living Stylist']],
            ['name' => 'Health & Fitness', 'slug' => 'health-fitness', 'icon' => '💪', 'subs' => ['Fitness Trainer of the Year', 'Mental Health Advocate', 'Wellness Pioneer', 'Nutritionist of the Year']],
            ['name' => 'Actor / Actress', 'slug' => 'actor-actress', 'icon' => '🎭', 'subs' => ['Best Lead Actor', 'Best Lead Actress', 'Breakout Talent in Film', 'Outstanding Stage Performance']],
            ['name' => 'Comedy', 'slug' => 'comedy', 'icon' => '🎙️', 'subs' => ['Stand-up Comedian of the Year', 'Digital Satirist', 'Best Scripted Comedy Content']],
            ['name' => 'Visual Arts', 'slug' => 'visual-arts', 'icon' => '🎨', 'subs' => ['Digital Artist of the Year', 'Fine Art Excellence', 'Graphic Designer of the Year', 'Best Motion Graphics']],
            ['name' => 'Fashion', 'slug' => 'fashion', 'icon' => '👗', 'subs' => ['Fashion Designer of the Year', 'Style Icon Award', 'Model of the Year', 'Emerging Streetwear Brand']],
            ['name' => 'Business', 'slug' => 'business', 'icon' => '📈', 'subs' => ['Entrepreneur of the Year', 'Startup of the Year', 'Young CEO Award', 'Social Enterprise Excellence']],
            ['name' => 'Food', 'slug' => 'food', 'icon' => '🍳', 'subs' => ['Chef of the Year', 'Food Content Creator', 'Restaurateur of the Year', 'Culinary Innovator']],
            ['name' => 'Music', 'slug' => 'music', 'icon' => '🎵', 'subs' => ['Songwriter of the Year', 'Music Producer of the Year', 'Best New Artist', 'Music Video of the Year']],
            ['name' => 'Sports', 'slug' => 'sports', 'icon' => '🏅', 'subs' => ['Sports Personality of the Year', 'Coach of the Year', 'Emerging Athlete', 'Sports Journalist of the Year']],
            ['name' => 'Podcast', 'slug' => 'podcast', 'icon' => '🎧', 'subs' => ['Best Interview Podcast', 'Narrative Podcast of the Year', 'Podcast Host of the Year', 'Breakout Audio Series']],
            ['name' => 'Tech', 'slug' => 'tech', 'icon' => '💻', 'subs' => ['Software Engineer of the Year', 'Tech Innovator of the Year', 'App of the Year', 'Cybersecurity Excellence']],
            ['name' => 'Dance', 'slug' => 'dance', 'icon' => '💃', 'subs' => ['Choreographer of the Year', 'Dance Influencer', 'Best Group Performance', 'Traditional Dance Guardian']],
            ['name' => 'Travel', 'slug' => 'travel', 'icon' => '✈️', 'subs' => ['Travel Vlogger of the Year', 'Destination Storyteller', 'Adventure Creator', 'Sustainable Travel Advocate']],
            ['name' => 'Campus Influencer', 'slug' => 'campus-influencer', 'icon' => '🎓', 'subs' => ['Student Leader of the Year', 'Campus Brand Ambassador', 'College Content Creator', 'Student Innovator']],
            ['name' => 'Corporate & Brand', 'slug' => 'corporate-brand', 'icon' => '🏢', 'subs' => ['Brand of the Year', 'PR Agency Excellence', 'CSR Initiative of the Year', 'Best Brand Identity']],
            ['name' => 'Sustainability & Climate', 'slug' => 'sustainability-climate', 'icon' => '🌱', 'subs' => ['Climate Change Advocate', 'Eco-friendly Brand of the Year', 'Sustainability Innovator', 'Conservation Leader']],
        ];

        foreach ($data as $item) {
            // 1. Create the Main Category
            $category = Category::create([
                'name' => $item['name'],
                'slug' => $item['slug'],
                'icon' => $item['icon'],
            ]);

            // 2. Create the Subcategories for this Category
            foreach ($item['subs'] as $subName) {
                $category->subcategories()->create([
                    'name' => $subName,
                    'slug' => Str::slug($subName),
                ]);
            }
        }
    }
}