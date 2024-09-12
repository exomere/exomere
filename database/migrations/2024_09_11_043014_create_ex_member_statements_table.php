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
        Schema::create('ex_member_statements', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('type', 20)->nullable()->comment('정산타입');
            $table->string('code', 12)->nullable()->comment('정산코드');
            $table->tinyInteger('member_seq')->comment('회원번호');
            $table->string('member_id', 40)->comment('아이디');
            $table->string('member_name', 40)->comment('회원명');
            $table->string('pre_position', 20)->nullable()->comment('이전 직급');
            $table->string('position', 20)->nullable()->comment('취득 직급');
            $table->integer('pv')->nullable()->default(0)->comment('PV');
            $table->integer('total_amount')->nullable()->default(0)->comment('누적매출');
            $table->integer('recruitment_amount')->nullable()->default(0)->comment('직접모집관리금');
            $table->integer('promote_prive')->nullable()->default(0)->comment('장려금');
            $table->integer('center_amount')->nullable()->default(0)->comment('지역사무실지원금');
            $table->integer('education_amount')->nullable()->default(0)->comment('교육지원금');
            $table->integer('wages')->nullable()->default(0)->comment('급여');
            $table->integer('incentives')->nullable()->default(0)->comment('인센티브');
            $table->integer('contribution_amount')->nullable()->default(0)->comment('우수총판기여금');
            $table->integer('payment_points')->nullable()->default(0)->comment('지급합계');
            $table->integer('total_payment')->nullable()->default(0)->comment('포인트지급합계');
            $table->integer('income_tax')->nullable()->default(0)->comment('소득세');
            $table->integer('residence_tax')->nullable()->default(0)->comment('주민세');
            $table->integer('total_deduction')->nullable()->default(0)->comment('공제합계');
            $table->integer('actual_amount')->nullable()->default(0)->comment('실지급액');

            $table->index('code', 'ex_member_statements_code_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ex_member_statements');
    }
};
