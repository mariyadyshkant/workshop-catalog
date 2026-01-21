<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Teacher;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teachers = [
            [
            'name' => 'Luca',
            'surname' => 'Bianchi',
            'email' => 'luca.bianchi@example.com',
            'bio' => 'Sviluppatore full stack con esperienza in PHP e Laravel.'
            ],
            [
            'name' => 'Giulia',
            'surname' => 'Rossi',
            'email' => 'giulia.rossi@example.com',
            'bio' => 'Fotografa professionista specializzata in ritratti e fotografia urbana.'
            ],
            [
            'name' => 'Marco',
            'surname' => 'Verdi',
            'email' => 'marco.verdi@example.com',
            'bio' => 'Formatrice e coach sulla produttività personale e gestione del tempo.'
            ],
            [
            'name' => 'Sara',
            'surname' => 'Neri',
            'email' => 'sara.neri@example.com',
            'bio' => 'Insegnante di cucina con 6 anni di esperienza.'
            ],
            [
            'name' => 'Alessandro',
            'surname' => 'Russo',
            'email' => 'alessandro.russo@example.com',
            'bio' => 'Esperto di giardinaggio e paesaggismo con passione per le piante autoctone.'
            ],
            [
            'name' => 'Elena',
            'surname' => 'Ferrari',
            'email' => 'elena.ferrari@example.com',
            'bio' => 'Insegnante di arte e disegno, con esperienza in varie tecniche artistiche, in particolare acquerello e pittura ad olio.'
            ]
        ];
        foreach ($teachers as $teacher) {
            Teacher::create(
                [
                    'name' => $teacher['name'],
                    'surname' => $teacher['surname'],
                    'email' => $teacher['email'],
                    'bio' => $teacher['bio']
                ]
            );
        }
    }
}
