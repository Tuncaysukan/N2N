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
        Schema::create('about_pages', function (Blueprint $table) {
            $table->id();
            $table->string('title_tr')->nullable();
            $table->string('title_en')->nullable();
            $table->text('content_tr')->nullable();
            $table->text('content_en')->nullable();
            $table->string('meta_title_tr')->nullable();
            $table->string('meta_title_en')->nullable();
            $table->text('meta_description_tr')->nullable();
            $table->text('meta_description_en')->nullable();
            $table->text('meta_keywords_tr')->nullable();
            $table->text('meta_keywords_en')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_pages');
    }
};
