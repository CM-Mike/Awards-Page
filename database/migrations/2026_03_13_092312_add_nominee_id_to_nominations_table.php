<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('nominations', function (Blueprint $table) {
            $table->unsignedBigInteger('nominee_id')->nullable();
            $table->foreign('nominee_id')->references('id')->on('nominees')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('nominations', function (Blueprint $table) {
            $table->dropForeign(['nominee_id']);
            $table->dropColumn('nominee_id');
        });
    }
};