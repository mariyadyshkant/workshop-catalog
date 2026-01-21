<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\Teacher;
use App\Models\Category;
use App\Models\Level;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all();
        $levels = Level::all();
        $teachers = Teacher::all();

        $courses = [
            [
                'title' => 'Corso di Laravel per Principianti',
                'description' => 'Impara le basi di Laravel, il framework PHP più popolare.',
                'requirements' => 'Conoscenze di base di PHP.',
                'duration_hours' => 20,
                'status' => 'In programma',
                'start_date' => '2026-07-01',
                'end_date' => '2026-07-31',
                'language' => 'Italiano',
                'delivery_mode' => 'Online',
                'category' => 'Programmazione',
                'level' => 'Principiante',
                'teacher_email' => 'luca.bianchi@example.com'
            ],
            [
                'title' => 'Fotografia Urbana Avanzata',
                'description' => 'Tecniche avanzate per catturare la bellezza della città.',
                'requirements' => 'Corso di fotografia base o esperienza equivalente.',
                'duration_hours' => 15,
                'status' => 'In programma',
                'start_date' => '2026-08-05',
                'end_date' => '2026-08-20',
                'language' => 'Italiano',
                'delivery_mode' => 'In presenza',
                'category' => 'Fotografia',
                'level' => 'Avanzado',
                'teacher_email' => 'giulia.rossi@example.com'
            ],
            [
                'title' => 'Gestione del Tempo e Produttività',
                'description' => 'Strategie per migliorare la tua produttività quotidiana.',
                'requirements' => 'Nessuno.',
                'duration_hours' => 10,
                'status' => 'In aggiornamento',
                'start_date' => '2026-09-10',
                'end_date' => '2026-09-20',
                'language' => 'Italiano',
                'delivery_mode' => 'Misto',
                'category' => 'Produttività',
                'level' => 'Intermedio',
                'teacher_email' => 'marco.verdi@example.com'
            ],
            [
                'title' => 'Cucina Italiana Tradizionale',
                'description' => 'Scopri i segreti della cucina italiana con ricette autentiche.',
                'requirements' => 'Passione per la cucina.',
                'duration_hours' => 25,
                'status' => 'Cancellato',
                'start_date' => '2026-10-01',
                'end_date' => '2026-10-31',
                'language' => 'Italiano',
                'delivery_mode' => 'In presenza',
                'category' => 'Cucina',
                'level' => 'Principiante',
                'teacher_email' => 'sara.neri@example.com'
            ],
            [
                'title' => 'Giardinaggio Sostenibile',
                'description' => 'Tecniche di giardinaggio rispettose dell\'ambiente.',
                'requirements' => 'Nessuno.',
                'duration_hours' => 18,
                'status' => 'In programma',
                'start_date' => '2026-11-15',
                'end_date' => '2026-12-05',
                'language' => 'Italiano',
                'delivery_mode' => 'Online',
                'category' => 'Giardinaggio',
                'level' => 'Intermedio',
                'teacher_email' => 'alessandro.russo@example.com'
            ]
        ];
        foreach ($courses as $course) {
            Course::create([
                'title' => $course['title'],
                'description' => $course['description'],
                'requirements' => $course['requirements'],
                'duration_hours' => $course['duration_hours'],
                'status' => $course['status'],
                'start_date' => $course['start_date'],
                'end_date' => $course['end_date'],
                'language' => $course['language'],
                'delivery_mode' => $course['delivery_mode'],
                'category_id' => $categories->where('name', $course['category'])->first()->id,
                'level_id' => $levels->where('name', $course['level'])->first()->id,
                'teacher_id' => $teachers->where('email', $course['teacher_email'])->first()->id,
            ]);
        }
    }
}
