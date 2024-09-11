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
        Schema::table('checking_accounts', function (Blueprint $table) {
            $table->integer('total_services')->nullable()->change(); // Hacer el campo nullable
            $table->integer('total_payments')->nullable()->change();  // Si también necesitas modificar este campo
        });
    }
    
    public function down(): void
    {
        Schema::table('checking_accounts', function (Blueprint $table) {
            $table->integer('total_services')->nullable(false)->change(); // Revertir el cambio
            $table->integer('total_payments')->nullable(false)->change();  // Revertir el cambio
        });
    }
};
