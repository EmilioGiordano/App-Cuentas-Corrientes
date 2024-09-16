php artisan make:migration <?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('checking_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_cliente')->constrained('clients')->onDelete('cascade');
            $table->string('fiscal_direction', 100);
            $table->string('nombre', 100);
            $table->decimal('saldo_a_pagar', 10, 2)->nullable();
            $table->unsignedInteger('total_services')->default(0);
            $table->unsignedInteger('total_payments')->default(0);
            $table->timestamps();
        });
    }

   
    public function down(): void
    {
        
    }
};
