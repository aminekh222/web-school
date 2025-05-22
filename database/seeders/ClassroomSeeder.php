<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Classroom;

class ClassroomSeeder extends Seeder
{
    public function run()
    {
        $classrooms = [
            [
                'name' => 'Salle 101',
                'capacity' => 30,
                'description' => 'Salle de cours standard',
                'is_active' => true,
            ],
            [
                'name' => 'Salle 102',
                'capacity' => 25,
                'description' => 'Salle de cours standard',
                'is_active' => true,
            ],
            [
                'name' => 'Salle 103',
                'capacity' => 35,
                'description' => 'Salle de cours standard',
                'is_active' => true,
            ],
            [
                'name' => 'Amphithéâtre A',
                'capacity' => 100,
                'description' => 'Grand amphithéâtre',
                'is_active' => true,
            ],
            [
                'name' => 'Laboratoire Informatique',
                'capacity' => 20,
                'description' => 'Salle équipée d\'ordinateurs',
                'is_active' => true,
            ],
        ];

        foreach ($classrooms as $classroom) {
            Classroom::create($classroom);
        }
    }
} 