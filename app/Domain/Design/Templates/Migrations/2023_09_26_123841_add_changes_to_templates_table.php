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
        Schema::table('templates', function (Blueprint $table) {
            $table->text('title')->nullable()->change();
            $table->text('description')->nullable()->change();
            $table->text('imagePath')->nullable()->change();
            $table->text('videoPath')->nullable()->change();
            $table->text('link_title')->nullable()->change();
            $table->text('page_slug')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('templates', function (Blueprint $table) {
            //
        });
    }
};
