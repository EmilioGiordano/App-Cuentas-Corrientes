<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->foreignId('id_condicion_fiscal')->nullable()->change();
        });
    } 
    
    public function down(): void
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->foreignId('id_condicion_fiscal')->nullable(false)->change();
        });
    }
};
