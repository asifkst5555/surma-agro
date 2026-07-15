<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->nullable()->constrained()->nullOnDelete();
            $table->string('image_path');
            $table->string('thumbnail_path')->nullable();
            $table->string('original_url')->nullable();
            $table->string('source')->nullable()->comment('unsplash, pexels, pixabay, serpapi, upload');
            $table->string('ai_tags')->nullable();
            $table->string('alt_text')->nullable();
            $table->string('title')->nullable();
            $table->integer('width')->nullable();
            $table->integer('height')->nullable();
            $table->integer('file_size')->nullable()->comment('bytes');
            $table->string('mime_type')->nullable();
            $table->boolean('is_primary')->default(false);
            $table->boolean('is_active')->default(true);
            $table->string('type')->default('product')->comment('product, gallery, hero, thumbnail');
            $table->json('metadata')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_images');
    }
};
