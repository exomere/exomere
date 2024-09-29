<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('ex_inquires', function (Blueprint $table) {
            $table->string('company_name', 100)->after('content');
            $table->string('nation', 3)->after('content');
            $table->string('email', 100)->after('content');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ex_inquires', function (Blueprint $table) {
            //
        });
    }
};
