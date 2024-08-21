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
        Schema::create('ex_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('member_seq', 60)->nullable()->comment('주문 멤버 시퀀스');
            $table->string('order_type', 60)->nullable()->comment('주문구분');
            $table->string('center_seq',20)->nullable()->comment('센터 seq');
            $table->string('receipt_method', 20)->nullable()->comment('수령 방법');
            $table->string('remark', 200)->nullable()->comment('비고');
            $table->integer('total_amount')->nullable()->comment('총 금액');
            $table->integer('payment_amount')->nullable()->comment('결제 금액');
            $table->integer('remaining_amount')->nullable()->comment('남은금액');
            $table->integer('cash_payment')->nullable()->comment('현금결제');
            $table->integer('point_payment')->nullable()->comment('포인트결제');
            $table->integer('account_payment')->nullable()->comment('계좌결제');
            $table->json('item_info', 16)->nullable()->comment('주문 상품 정보');
            $table->json('card_info')->nullable()->comment('결제 카드 정보');
            $table->json('account_info')->nullable()->comment('계좌이체 정보');
            $table->dateTime('order_date')->comment('주문날짜');
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
        Schema::dropIfExists('ex_orders');
    }
};
