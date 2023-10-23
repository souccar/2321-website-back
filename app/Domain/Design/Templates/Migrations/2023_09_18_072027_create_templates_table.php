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
        Schema::create('templates', function (Blueprint $table) {
            $table->id();
            $table->integer('type')->nullable();
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->string('imagePath')->nullable();
            $table->string('videoPath')->nullable();
            $table->string('link_title')->nullable();
            $table->string('page_slug');
            $table->integer('numberOfColumns')->nullable();
            $table->foreignId('parentTemplateId')->nullable()->constrained('templates')->onDelete('cascade');
            $table->softDeletes(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('templates');
    }
};
