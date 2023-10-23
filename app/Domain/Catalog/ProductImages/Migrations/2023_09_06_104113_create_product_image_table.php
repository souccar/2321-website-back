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
        Schema::create('productImages', function (Blueprint $table) {
            $table->id();
            $table->string('imagePath');
            $table->bigInteger('productId')->unsigned()->nullable();
            $table->foreign('productId')->references('id')->on('products')->onDelete("set null"); 
            $table->softDeletes();   
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productImages');
    }
};
