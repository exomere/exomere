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
        Schema::table('ex_reviews', function (Blueprint $table) {
            $table->string('file1')->nullable()->change(); // `NOT NULL` 해제
            $table->string('file2')->nullable()->change(); // `NOT NULL` 해제
            $table->string('file3')->nullable()->change(); // `NOT NULL` 해제
            $table->string('file4')->nullable()->change(); // `NOT NULL` 해제
            $table->string('file5')->nullable()->change(); // `NOT NULL` 해제
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reviews', function (Blueprint $table) {
            //
        });
    }
};
