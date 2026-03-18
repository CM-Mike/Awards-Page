<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Subcategory;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        // ====================== 1 ======================
        $c1 = Category::firstOrCreate(
            ['name' => 'Entertainment & Arts'],
            ['slug' => 'entertainment-arts']
        );
        Subcategory::firstOrCreate(['slug' => 'music-artist'],     ['category_id' => $c1->id, 'name' => 'Music Artist / Performer']);
        Subcategory::firstOrCreate(['slug' => 'film-actor'],       ['category_id' => $c1->id, 'name' => 'Film & Television Actor/Actress']);
        Subcategory::firstOrCreate(['slug' => 'content-creator'],  ['category_id' => $c1->id, 'name' => 'Content Creator / Influencer']);
        Subcategory::firstOrCreate(['slug' => 'comedian'],         ['category_id' => $c1->id, 'name' => 'Comedian / Satirist']);
        Subcategory::firstOrCreate(['slug' => 'visual-artist'],    ['category_id' => $c1->id, 'name' => 'Visual Artist / Painter / Sculptor']);

        // ====================== 2 ======================
        $c2 = Category::firstOrCreate(['name' => 'Creative Industries'], ['slug' => 'creative-industries']);
        Subcategory::firstOrCreate(['slug' => 'fashion-designer'], ['category_id' => $c2->id, 'name' => 'Fashion Designer']);
        Subcategory::firstOrCreate(['slug' => 'photographer'],     ['category_id' => $c2->id, 'name' => 'Photographer']);
        Subcategory::firstOrCreate(['slug' => 'graphic-designer'], ['category_id' => $c2->id, 'name' => 'Graphic Designer / Illustrator']);
        Subcategory::firstOrCreate(['slug' => 'filmmaker'],        ['category_id' => $c2->id, 'name' => 'Filmmaker / Director']);

        // ====================== 3 ======================
        $c3 = Category::firstOrCreate(['name' => 'Music & Audio'], ['slug' => 'music-audio']);
        Subcategory::firstOrCreate(['slug' => 'music-producer'],   ['category_id' => $c3->id, 'name' => 'Music Producer']);
        Subcategory::firstOrCreate(['slug' => 'dj'],               ['category_id' => $c3->id, 'name' => 'DJ']);
        Subcategory::firstOrCreate(['slug' => 'gospel-artist'],    ['category_id' => $c3->id, 'name' => 'Gospel Artist']);
        Subcategory::firstOrCreate(['slug' => 'songwriter'],       ['category_id' => $c3->id, 'name' => 'Songwriter / Composer']);

        // ====================== 4 ======================
        $c4 = Category::firstOrCreate(['name' => 'Business & Entrepreneurship'], ['slug' => 'business-entrepreneurship']);
        Subcategory::firstOrCreate(['slug' => 'startup-founder'],  ['category_id' => $c4->id, 'name' => 'Startup Founder']);
        Subcategory::firstOrCreate(['slug' => 'sme-leader'],       ['category_id' => $c4->id, 'name' => 'Small & Medium Enterprise Leader']);
        Subcategory::firstOrCreate(['slug' => 'corporate-executive'], ['category_id' => $c4->id, 'name' => 'Corporate Executive']);
        Subcategory::firstOrCreate(['slug' => 'social-entrepreneur'], ['category_id' => $c4->id, 'name' => 'Social Entrepreneur']);

        // ====================== 5 ======================
        $c5 = Category::firstOrCreate(['name' => 'Technology & Innovation'], ['slug' => 'technology-innovation']);
        Subcategory::firstOrCreate(['slug' => 'software-developer'], ['category_id' => $c5->id, 'name' => 'Software Developer / Engineer']);
        Subcategory::firstOrCreate(['slug' => 'ai-specialist'],      ['category_id' => $c5->id, 'name' => 'AI / Machine Learning Specialist']);
        Subcategory::firstOrCreate(['slug' => 'fintech-innovator'],  ['category_id' => $c5->id, 'name' => 'FinTech Innovator']);
        Subcategory::firstOrCreate(['slug' => 'cybersecurity'],      ['category_id' => $c5->id, 'name' => 'Cybersecurity Expert']);

        // ====================== 6 ======================
        $c6 = Category::firstOrCreate(['name' => 'Education & Mentorship'], ['slug' => 'education-mentorship']);
        Subcategory::firstOrCreate(['slug' => 'teacher'],     ['category_id' => $c6->id, 'name' => 'Teacher / Lecturer']);
        Subcategory::firstOrCreate(['slug' => 'researcher'],  ['category_id' => $c6->id, 'name' => 'Academic Researcher']);
        Subcategory::firstOrCreate(['slug' => 'mentor'],      ['category_id' => $c6->id, 'name' => 'Mentor / Coach']);

        // ====================== 7 ======================
        $c7 = Category::firstOrCreate(['name' => 'Health & Wellness'], ['slug' => 'health-wellness']);
        Subcategory::firstOrCreate(['slug' => 'medical-doctor'],         ['category_id' => $c7->id, 'name' => 'Medical Professional / Doctor']);
        Subcategory::firstOrCreate(['slug' => 'mental-health-advocate'], ['category_id' => $c7->id, 'name' => 'Mental Health Advocate']);
        Subcategory::firstOrCreate(['slug' => 'fitness-coach'],          ['category_id' => $c7->id, 'name' => 'Fitness & Lifestyle Coach']);

        // ====================== 8 ======================
        $c8 = Category::firstOrCreate(['name' => 'Sports & Athletics'], ['slug' => 'sports-athletics']);
        Subcategory::firstOrCreate(['slug' => 'individual-athlete'], ['category_id' => $c8->id, 'name' => 'Individual Athlete']);
        Subcategory::firstOrCreate(['slug' => 'team-sports'],        ['category_id' => $c8->id, 'name' => 'Team Sports Player']);
        Subcategory::firstOrCreate(['slug' => 'sports-coach'],       ['category_id' => $c8->id, 'name' => 'Sports Coach / Trainer']);

        // ====================== 9 ======================
        $c9 = Category::firstOrCreate(['name' => 'Media & Journalism'], ['slug' => 'media-journalism']);
        Subcategory::firstOrCreate(['slug' => 'journalist'],     ['category_id' => $c9->id, 'name' => 'News Anchor / Journalist']);
        Subcategory::firstOrCreate(['slug' => 'radio-host'],     ['category_id' => $c9->id, 'name' => 'Radio / Podcast Host']);
        Subcategory::firstOrCreate(['slug' => 'digital-media'],  ['category_id' => $c9->id, 'name' => 'Digital Media Publisher']);

        // ====================== 10 ======================
        $c10 = Category::firstOrCreate(['name' => 'Social Impact & Activism'], ['slug' => 'social-impact']);
        Subcategory::firstOrCreate(['slug' => 'community-leader'], ['category_id' => $c10->id, 'name' => 'Community Leader']);
        Subcategory::firstOrCreate(['slug' => 'human-rights'],     ['category_id' => $c10->id, 'name' => 'Human Rights Advocate']);
        Subcategory::firstOrCreate(['slug' => 'environment'],      ['category_id' => $c10->id, 'name' => 'Environmental Champion']);

        // ====================== 11 ======================
        $c11 = Category::firstOrCreate(['name' => 'Agriculture & Agribusiness'], ['slug' => 'agriculture']);
        Subcategory::firstOrCreate(['slug' => 'commercial-farmer'], ['category_id' => $c11->id, 'name' => 'Commercial Farmer']);
        Subcategory::firstOrCreate(['slug' => 'agri-tech'],         ['category_id' => $c11->id, 'name' => 'Agri-Tech Innovator']);
        Subcategory::firstOrCreate(['slug' => 'value-addition'],    ['category_id' => $c11->id, 'name' => 'Value-Addition Entrepreneur']);

        // ====================== 12 ======================
        $c12 = Category::firstOrCreate(['name' => 'Tourism & Hospitality'], ['slug' => 'tourism-hospitality']);
        Subcategory::firstOrCreate(['slug' => 'tour-operator'],     ['category_id' => $c12->id, 'name' => 'Tour Operator / Guide']);
        Subcategory::firstOrCreate(['slug' => 'hospitality-manager'],['category_id' => $c12->id, 'name' => 'Hotel / Lodge Manager']);

        // ====================== 13 ======================
        $c13 = Category::firstOrCreate(['name' => 'Fashion & Beauty'], ['slug' => 'fashion-beauty']);
        Subcategory::firstOrCreate(['slug' => 'model'],               ['category_id' => $c13->id, 'name' => 'Model']);
        Subcategory::firstOrCreate(['slug' => 'makeup-stylist'],      ['category_id' => $c13->id, 'name' => 'Makeup Artist / Stylist']);
        Subcategory::firstOrCreate(['slug' => 'beauty-salon-brand'],  ['category_id' => $c13->id, 'name' => 'Beauty Salon / Brand']);

        // ====================== 14 ======================
        $c14 = Category::firstOrCreate(['name' => 'Literature & Publishing'], ['slug' => 'literature-publishing']);
        Subcategory::firstOrCreate(['slug' => 'author'], ['category_id' => $c14->id, 'name' => 'Author / Writer']);
        Subcategory::firstOrCreate(['slug' => 'poet'],   ['category_id' => $c14->id, 'name' => 'Poet / Spoken Word Artist']);

        // ====================== 15 ======================
        $c15 = Category::firstOrCreate(['name' => 'Youth Leadership & Innovation'], ['slug' => 'youth-leadership']);
        Subcategory::firstOrCreate(['slug' => 'youth-advocate'],   ['category_id' => $c15->id, 'name' => 'Youth Advocate']);
        Subcategory::firstOrCreate(['slug' => 'student-leader'],   ['category_id' => $c15->id, 'name' => 'Student Leader / Innovator']);

        // ====================== 16 ======================
        $c16 = Category::firstOrCreate(['name' => 'Public Service & Governance'], ['slug' => 'public-service']);
        Subcategory::firstOrCreate(['slug' => 'civil-servant'], ['category_id' => $c16->id, 'name' => 'Civil Servant / Policy Maker']);
        Subcategory::firstOrCreate(['slug' => 'elected-leader'], ['category_id' => $c16->id, 'name' => 'Elected Leader']);

        // ====================== 17 ======================
        $c17 = Category::firstOrCreate(['name' => 'Lifetime Achievement'], ['slug' => 'lifetime-achievement']);
        Subcategory::firstOrCreate(['slug' => 'lifetime-arts'],    ['category_id' => $c17->id, 'name' => 'Lifetime Contribution (Arts)']);
        Subcategory::firstOrCreate(['slug' => 'lifetime-business'],['category_id' => $c17->id, 'name' => 'Lifetime Contribution (Business)']);
        Subcategory::firstOrCreate(['slug' => 'lifetime-social'],  ['category_id' => $c17->id, 'name' => 'Lifetime Contribution (Social Impact)']);

        $this->command->info('17 Categories and Subcategories seeded successfully!');
    }
}