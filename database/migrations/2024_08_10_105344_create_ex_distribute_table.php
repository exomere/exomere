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
        Schema::create('ex_distribute', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('director_seq')->comment('분양몰 관리자 seq');
            $table->string('name', 60)->nullable()->comment('분양몰 이름');
            $table->string('code', 60)->nullable()->comment('분양몰 코드');
            $table->string('director_name',20)->comment('분양몰 관리자 이름');
            $table->string('pg_code', 100)->nullable()->comment('pg사 코드');
            $table->string('business_num', 20)->nullable()->comment('사업자등록번호');
            $table->string('director_phone', 16)->nullable()->comment('관리자 휴대폰번호');
            $table->string('phone', 16)->nullable()->comment('휴대폰번호');
            $table->string('fax', 20)->nullable()->comment('팩스번호');
            $table->string('address', 80)->nullable()->comment('주소');
            $table->string('address_detail', 100)->nullable()->comment('상세주소');
            $table->string('zipcode', 16)->nullable()->comment('우편코드');
            $table->string('bank', 10)->nullable()->comment('은행');
            $table->string('account_num', 32)->nullable()->comment('계좌번호');
            $table->string('account_holder', 40)->nullable()->comment('예금주');
            $table->string('remark', 200)->nullable()->comment('비고');
            $table->enum('is_actice', ['Y', 'N'])->comment('사용여부');
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
        Schema::dropIfExists('ex_distribute');
    }
};
