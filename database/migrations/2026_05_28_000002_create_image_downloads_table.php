<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('image_downloads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->nullable()->constrained()->nullOnDelete();
            $table->string('search_query')->nullable();
            $table->string('source');
            $table->string('original_url');
            $table->string('local_path')->nullable();
            $table->string('status')->default('pending')->comment('pending, downloading, completed, failed');
            $table->text('error_message')->nullable();
            $table->json('response_data')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('image_downloads');
    }
};
