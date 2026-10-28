<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    public function run(): void
    {
        Plan::updateOrCreate(
            ['name' => 'Gratis'],
            [
                'price' => 0.00,
                'description' => null,
                'features' => ['Temporizador de ciclos', 'Estadísticas de 7 días'],
                'excluded_features' => ['Modo sin distracciones'],
                'period' => 'mes',
                'featured' => false,
            ]
        );

        Plan::updateOrCreate(
            ['name' => 'Pro'],
            [
                'price' => 6.00,
                'description' => null,
                'features' => ['Temporizador de ciclos', 'Estadísticas ilimitadas', 'Modo sin distracciones'],
                'excluded_features' => null,
                'period' => 'mes',
                'featured' => true,
            ]
        );

        Plan::updateOrCreate(
            ['name' => 'Equipos'],
            [
                'price' => 4.00,
                'description' => null,
                'features' => ['Todo lo de Pro', 'Panel de equipo', 'Soporte prioritario'],
                'excluded_features' => null,
                'period' => 'usuario',
                'featured' => false,
            ]
        );
    }
}
