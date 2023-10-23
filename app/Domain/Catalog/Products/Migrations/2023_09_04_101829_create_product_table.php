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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->double('point');
            $table->bigInteger('categoryId')->unsigned()->nullable();
            $table->foreign('categoryId')->references('id')->on('categories')->onDelete("set null"); 
            // $table->foreignId('categoryId')->nullable()->constrained('categories')->onDelete('cascade');
            $table->foreignId('brandId')->nullable()->constrained('brands')->onDelete('cascade');
            $table->foreignId('skinTypeId')->nullable()->constrained('skinTypes')->onDelete('cascade');
            $table->softDeletes();          
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
