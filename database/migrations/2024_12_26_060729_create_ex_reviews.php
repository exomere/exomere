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
        Schema::create('ex_reviews', function (Blueprint $table) {
            $table->id();
            $table->string('author_name')->nullable()->comment('작성자 이름');
            $table->integer('author_seq')->nullable()->comment('작성자 SEQ');
            $table->string('title')->nullable()->comment('제목');
            $table->text('content')->nullable()->comment('내용');
            $table->integer('rating')->nullable()->comment('평점');
            $table->integer('product_seq')->nullable()->comment('상품 SEQ');
            $table->string('file1');
            $table->string('file2');
            $table->string('file3');
            $table->string('file4');
            $table->string('file5');
            $table->enum('is_view', ['Y', 'N'])->default('Y')->comment('게시 여부');
            $table->timestamps();

            $table->foreign('product_seq')->references('id')->on('ex_items')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ex_reviews');
    }
};
