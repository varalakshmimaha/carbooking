<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Update Services Table (Already executed in previous failed attempt)
        // Schema::table('services', function (Blueprint $table) {
        //     $table->string('slug')->unique()->after('name');
        //     $table->string('short_description', 150)->nullable()->after('slug');
        //     $table->longText('full_description')->nullable()->after('short_description');
        //     // Drop old description if it exists, or rename/reuse it. Since it's nullable text, we can just drop it and use full_description for clarity, or map it.
        //     // Let's assume we want new structure.
        //     $table->dropColumn('description');
            
        //     $table->string('icon_class')->nullable()->after('icon'); // keeping icon column for now or replace? User asked for Icon Class
        //     // Let's drop old 'icon' if it was just a string path, and use icon_class for font awesome
        //     $table->dropColumn('icon');

        //     $table->string('featured_image')->nullable()->after('full_description');
        //     $table->string('banner_image')->nullable()->after('featured_image');
        //     $table->integer('display_order')->default(0)->after('banner_image');
        //     $table->string('meta_title')->nullable()->after('display_order');
        //     $table->text('meta_description')->nullable()->after('meta_title');
        // });

        // 2. Blog Categories
        Schema::create('blog_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('status')->default('active');
            $table->timestamps();
        });

        // 3. Blog Tags
        Schema::create('blog_tags', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->timestamps();
        });

        // 4. Blog Posts
        Schema::create('blog_posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->nullable()->constrained('blog_categories')->onDelete('set null');
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('short_description')->nullable();
            $table->longText('full_content')->nullable();
            $table->string('featured_image')->nullable();
            $table->string('banner_image')->nullable();
            $table->string('author_name')->nullable();
            $table->dateTime('publish_date')->nullable();
            $table->string('estimated_reading_time')->nullable();
            $table->integer('views')->default(0);
            $table->string('status')->default('draft'); // published, draft
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->timestamps();
        });

        // 5. Blog Post Tags Pivot
        Schema::create('blog_post_tags', function (Blueprint $table) {
            $table->id();
            $table->foreignId('blog_post_id')->constrained()->onDelete('cascade');
            $table->foreignId('blog_tag_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });

        // 6. Testimonials
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name');
            $table->string('designation')->nullable();
            $table->string('company_name')->nullable();
            $table->string('photo')->nullable();
            $table->integer('rating')->default(5);
            $table->text('message')->nullable();
            $table->string('location')->nullable();
            $table->integer('display_order')->default(0);
            $table->string('status')->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testimonials');
        Schema::dropIfExists('blog_post_tags');
        Schema::dropIfExists('blog_posts');
        Schema::dropIfExists('blog_tags');
        Schema::dropIfExists('blog_categories');

        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn(['slug', 'short_description', 'full_description', 'icon_class', 'featured_image', 'banner_image', 'display_order', 'meta_title', 'meta_description']);
            $table->string('icon')->nullable();
            $table->text('description')->nullable();
        });
    }
};
