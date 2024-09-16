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
        
        $table->unsignedBigInteger('id_servicio')->nullable(); 
        $table->foreign('id_servicio', 'id_servicio_payment')->references('id')->on('services')
        ->onDelete('cascade')->onUpdate('cascade');

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