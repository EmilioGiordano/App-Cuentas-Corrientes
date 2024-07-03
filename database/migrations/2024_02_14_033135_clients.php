<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_condicion_fiscal')->constrained('fiscal_conditions')->onDelete('cascade');
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade');

            $table->string('nombre', 100);
            $table->string('apellido', 100);
            $table->string('dni', 8);
            $table->string('cuitcuil', 11);
            $table->string('email', 70);
            $table->string('telefono', 50);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};