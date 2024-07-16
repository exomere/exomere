<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ex_members', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code', 12)->nullable()->comment('회원코드');
            $table->tinyInteger('type')->default(3)->comment('회원타입');
            $table->string('member_id', 40)->comment('아이디');
            $table->string('member_pw', 160)->comment('비밀번호');
            $table->string('tel', 16)->nullable()->comment('전화번호');
            $table->string('phone', 16)->nullable()->comment('휴대폰번호');
            $table->string('email', 80)->nullable()->comment('이메일');
            $table->string('area', 20)->nullable()->comment('지역점');
            $table->integer('exclusive_seq')->nullable()->comment('총판 SEQ');
            $table->integer('recommend_seq')->nullable()->comment('추천인 SEQ');
            $table->string('zip_code', 16)->nullable()->comment('우편코드');
            $table->string('address', 80)->nullable()->comment('주소');
            $table->string('address_detail', 100)->nullable()->comment('상세주소');
            $table->string('country', 4)->nullable()->comment('나라');
            $table->integer('remain_points')->nullable()->comment('잔여포인트');
            $table->integer('payment_points')->nullable()->comment('지급포인트');
            $table->dateTime('created_at')->nullable()->comment('생성일');
            $table->dateTime('updated_at')->nullable()->comment('갱신일');
            $table->dateTime('deleted_at')->nullable()->comment('삭제일');

            $table->index('code', 'ex_members_code_index');
            $table->index('member_id', 'ex_members_member_id_index');
            $table->index('type', 'ex_members_type_index');
            $table->index('area', 'ex_members_area_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ex_members');
    }
};
