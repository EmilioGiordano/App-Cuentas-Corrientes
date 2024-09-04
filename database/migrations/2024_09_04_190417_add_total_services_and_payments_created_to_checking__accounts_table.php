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
        Schema::table('checking_Accounts', function (Blueprint $table) {
            $table->unsignedInteger('total_services');
            $table->unsignedInteger('total_payments');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('checking_Accounts', function (Blueprint $table) {
            $table->dropColumn('total_services');
            $table->dropColumn('total_payments');
        });
    }
};