<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_cuenta')->constrained('checking_accounts')->onDelete('cascade');
            $table->foreignId('id_servicio')->constrained('services')->onDelete('cascade');
            $table->decimal('monto', 10, 2);
            
            $table->string('detalles', 255);
            $table->date('fecha'); 

            $table->timestamps();
        });
    }
    public function down(): void
    {
       
    }
};