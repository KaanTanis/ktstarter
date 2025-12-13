<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create(config('filament-fabricator.table_name', 'pages'), function (Blueprint $table) {
            $table->id();
            $table->string('title')->index();
            $table->string('slug');
            $table->string('layout')->default('default')->index();
            $table->json('blocks');
            $table->foreignId('parent_id')->nullable()->constrained(config('filament-fabricator.table_name', 'pages'))->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('seo_title')->nullable()->after('title');
            $table->string('seo_description')->nullable()->after('seo_title');
            // SEO and Sitemap fields
            $table->decimal('sitemap_priority', 2, 1)->default(0.6);
            $table->enum('sitemap_change_freq', [
                'always', 'hourly', 'daily', 'weekly', 'monthly', 'yearly', 'never',
            ])->default('weekly');
            $table->boolean('include_in_sitemap')->default(true);
            // -----------------------
            $table->unsignedBigInteger('views_count')->default(0);
            $table->timestamps();

            $table->unique(['slug', 'parent_id']);
            $table->index('include_in_sitemap');
            $table->index('views_count');
        });
    }

    public function down()
    {
        Schema::dropIfExists(config('filament-fabricator.table_name', 'pages'));
    }
};
