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
        Schema::create('subcategories', function (Blueprint $table) {
            $table->id();
            // This links the subcategory to a category in your 'categories' table
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            
            $table->string('name'); // e.g., "Best Tech Startup"
            $table->string('slug')->unique(); // e.g., "best-tech-startup"
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subcategories');
    }
};