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
        Schema::create('ex_statements', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('type', 20)->nullable()->comment('정산타입');
            $table->string('code', 16)->nullable()->comment('정산코드');
            $table->integer('total_amount')->nullable()->default(0)->comment('매출액');
            $table->integer('total_pv')->nullable()->default(0)->comment('PV');
            $table->integer('total_payment')->nullable()->default(0)->comment('합계금액');
            $table->integer('actual_amount')->nullable()->default(0)->comment('실지급액');
            $table->dateTime('deadline_date')->nullable()->comment('마감일자');
            $table->dateTime('s_date')->nullable()->comment('시작일자');
            $table->dateTime('e_date')->nullable()->comment('종료일자');
            $table->string('reg_name', 40)->nullable()->comment('마감자');

            $table->index('code', 'ex_statements_code_index');
            $table->index('s_date', 'ex_statements_s_date_index');
            $table->index('e_date', 'ex_statements_e_date_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ex_statements');
    }
};
