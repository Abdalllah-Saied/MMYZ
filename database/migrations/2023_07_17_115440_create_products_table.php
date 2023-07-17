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
            $table->decimal('price', 8, 2);
            $table->integer('quantity');
            $table->string('color')->nullable();
            $table->string('image')->nullable();
            $table->string('code')->unique();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('branch_id');
            $table->timestamps();


            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('branch_id')->references('id')->on('branches');
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
