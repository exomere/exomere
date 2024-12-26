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
        Schema::create('ex_reviews_likes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('review_seq')->nullable()->comment('리뷰 SEQ');
            $table->unsignedBigInteger('author_seq')->nullable()->comment('작성자 SEQ');
            $table->timestamps();

            $table->foreign('review_seq')->references('id')->on('ex_reviews')->onDelete('cascade');
            $table->unique(['review_seq', 'author_seq']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ex_reviews_likes');
    }
};
