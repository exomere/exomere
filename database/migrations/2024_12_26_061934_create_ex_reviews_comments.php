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
        Schema::create('ex_reviews_comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('review_seq')->nullable()->comment('리뷰 SEQ');
            $table->string('author_name')->nullable()->comment('리뷰 답변 작성자 이름');
            $table->unsignedBigInteger('author_seq')->nullable()->comment('리뷰 답변 작성자 SEQ');
            $table->text('content')->nullable()->comment('리뷰 답변 내용');
            $table->timestamps();

            $table->foreign('review_seq')->references('id')->on('ex_reviews')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ex_reviews_comments');
    }
};
