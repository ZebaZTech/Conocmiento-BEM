<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        Testimonial::updateOrCreate(
            ['name' => 'Laura Mejía'],
            [
                'role' => 'Estudiante de ingeniería',
                'text' => 'Pasé de distraerme cada diez minutos a terminar mis entregas antes del viernes.',
                'initials' => 'LM',
                'variant' => 'highlight',
            ]
        );

        Testimonial::updateOrCreate(
            ['name' => 'Juan Restrepo'],
            [
                'role' => 'Diseñador freelance',
                'text' => 'Las estadísticas me mostraron que rindo más por la mañana. Reorganicé mi agenda.',
                'initials' => 'JR',
                'variant' => 'normal',
            ]
        );

        Testimonial::updateOrCreate(
            ['name' => 'Sara Gómez'],
            [
                'role' => 'Líder de producto',
                'text' => 'Usamos Focus Work en todo el equipo y las reuniones bajaron a la mitad.',
                'initials' => 'SG',
                'variant' => 'compact',
            ]
        );
    }
}
