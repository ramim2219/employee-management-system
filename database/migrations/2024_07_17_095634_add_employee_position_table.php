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
        Schema::table('employee', function (Blueprint $table) {
            $table->unsignedBigInteger('employee_position')->nullable();
            $table->foreign('employee_position')->references('id')->on('position')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employee', function (Blueprint $table) {
            $table->dropForeign(['employee_position']);
            $table->dropColumn('employee_position');
        });
    }
};
