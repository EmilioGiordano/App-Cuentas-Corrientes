<?php

namespace Database\Seeders;

use App\Models\FiscalCondition;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
class FiscalConditionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Resetear 
        DB::statement("DELETE FROM fiscal_conditions");
        DB::statement("ALTER TABLE fiscal_conditions AUTO_INCREMENT = 1");
   


        $fiscalConditions = [
            ['nombre_categoria' => 'IVA exento'],
            ['nombre_categoria' => 'Monotributista'],
            ['nombre_categoria' => 'Consumidor Final'],
            ['nombre_categoria' => 'Sujeto no categorizado'],
            ['nombre_categoria' => 'Proveedor del exterior'],
            ['nombre_categoria' => 'Cliente del exterior'],
            ['nombre_categoria' => 'IVA liberado ley 19640'],
            ['nombre_categoria' => 'IVA no alcanzado'],
            ['nombre_categoria' => 'Responsable Inscripto'],
        ];
        
       
        DB::table('fiscal_conditions')->insert($fiscalConditions);
    }
}
