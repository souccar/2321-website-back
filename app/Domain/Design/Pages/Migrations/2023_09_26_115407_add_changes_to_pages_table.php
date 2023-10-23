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
        Schema::table('pages', function (Blueprint $table) {
            $table->text('slug')->nullable()->change();
            $table->text('title')->nullable()->change();
            $table->text('description')->nullable()->change();
            $table->text('imagePath')->nullable()->change();
            $table->text('image_title')->nullable()->change();
            $table->text('image_description')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            //
        });
    }
};
