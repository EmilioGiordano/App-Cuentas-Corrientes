
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_servicio')->constrained('services')->onDelete('cascade');
            $table->string('file_name');
         
            $table->timestamps();
        });
     
    }
   
    public function down(): void
    {
    
    }
};
