<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('assign_task', function (Blueprint $table) {
            $table->unsignedTinyInteger('status')->default(0)->after('description');
        });
    }
    public function down(): void
    {
        Schema::table('assign_task', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
