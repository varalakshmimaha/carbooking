<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Page;
use App\Models\SectionType;
use App\Models\PageSection;

class UpdateBlogsPageSeeder extends Seeder
{
    public function run()
    {
        // 1. Ensure SectionType 'blogs_list' exists
        $blogsListType = SectionType::firstOrCreate(
            ['key' => 'blogs_list'],
            [
                'name' => 'Blogs List',
                'description' => 'Displays list of blog posts in grid',
                'icon' => 'newspaper' // assuming icon column exists
            ]
        );

        // 2. Find 'blogs' page
        $page = Page::where('slug', 'blogs')->first();
        
        if ($page) {
            // 3. Clear existing sections to avoid duplicates
            // We only remove if we are sure we want to replace. Here we assume we want to SET the content.
            // Or better, check if exists. But deleting is cleaner for "Fix".
            $page->sections()->delete();

            // 4. Add 'blogs_list' section
            PageSection::create([
                'page_id' => $page->id,
                'section_type_id' => $blogsListType->id,
                'position' => 0,
                'is_visible' => true,
                'settings' => [
                    'title' => 'Our Travel Stories',
                    'subtitle' => 'Explore the world with our latest articles and tips.'
                ]
            ]);
            
            $this->command->info('Blogs page updated with blogs_list section.');
        } else {
            $this->command->error('Page with slug "blogs" not found.');
        }
    }
}
