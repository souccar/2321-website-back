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
        Schema::create('productSizes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('size');
            $table->enum('unit', ['ml','l','g','kg'])->default('ml');
            // $table->string('unit')->default('ml');
            $table->bigInteger('ProductId')->unsigned()->nullable();
            $table->foreign('ProductId')->references('id')->on('products')->onDelete("set null");
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productSizes');
    }
};
