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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('content');
            $table->dateTime('published_at')->nullable();
            $table->string('seo_title')->nullable();
            $table->text('seo_description')->nullable();
            $table->unsignedBigInteger('views_count')->default(0);
            // SEO and Sitemap fields
            $table->decimal('sitemap_priority', 2, 1)->default(0.6);
            $table->enum('sitemap_change_freq', [
                'always', 'hourly', 'daily', 'weekly', 'monthly', 'yearly', 'never',
            ])->default('weekly');
            $table->boolean('include_in_sitemap')->default(true);
            // -----------------------
            $table->timestamps();

            $table->index('views_count');
            $table->index('slug');
            $table->index('published_at');
            $table->index('created_at');
            $table->index('updated_at');
            $table->index('include_in_sitemap');
        });

        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->timestamps();

            $table->index('slug');
        });

        Schema::create('post_tag', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id')->constrained()->onDelete('cascade');
            $table->foreignId('tag_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
        Schema::dropIfExists('tags');
        Schema::dropIfExists('post_tag');
    }
};
