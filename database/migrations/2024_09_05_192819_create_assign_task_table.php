<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('assign_task', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->string('title', 255);
            $table->text('description');
            $table->timestamps();

            $table->foreign('employee_id')->references('user_id')->on('employee')->onDelete('cascade')->onUpdate('cascade');
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('assign_task');
    }
};
