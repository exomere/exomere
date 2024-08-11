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
        Schema::create('ex_center', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 60)->nullable()->comment('센터이름');
            $table->integer('director_seq')->comment('센터장 seq');
            $table->integer('recommended_seq')->comment('추천인 seq');
            $table->string('phone', 16)->nullable()->comment('휴대폰번호');
            $table->string('fax', 20)->nullable()->comment('팩스번호');
            $table->string('zipcode', 16)->nullable()->comment('우편코드');
            $table->string('address', 80)->nullable()->comment('주소');
            $table->string('address_detail', 100)->nullable()->comment('상세주소');
            $table->string('remark', 200)->nullable()->comment('비고');
            $table->enum('is_actice', ['Y', 'N']);
            $table->dateTime('created_at')->nullable()->comment('생성일');
            $table->dateTime('updated_at')->nullable()->comment('갱신일');
            $table->dateTime('deleted_at')->nullable()->comment('삭제일');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ex_center');
    }
};
