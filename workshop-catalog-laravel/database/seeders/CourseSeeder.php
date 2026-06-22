<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\Teacher;
use App\Models\Category;
use App\Models\Level;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::all();
        $levels = Level::all();
        $teachers = Teacher::all();

        $courses = [
            [
                'title' => 'Laravel per Principianti',
                'description' => 'Impara le basi di Laravel, il framework PHP più popolare al mondo. Scoprirai routing, Eloquent ORM, Blade templating e molto altro.',
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
                'title' => 'React & TypeScript: da zero a pro',
                'description' => 'Costruisci applicazioni moderne con React 18 e TypeScript. Componenti, hooks, stato globale, routing e best practice.',
                'requirements' => 'Conoscenze base di JavaScript e HTML.',
                'duration_hours' => 30,
                'status' => 'In programma',
                'start_date' => '2026-08-01',
                'end_date' => '2026-09-15',
                'language' => 'Italiano',
                'delivery_mode' => 'Online',
                'category' => 'Programmazione',
                'level' => 'Intermedio',
                'teacher_email' => 'luca.bianchi@example.com'
            ],
            [
                'title' => 'Fotografia Urbana Avanzata',
                'description' => 'Tecniche avanzate per catturare la bellezza della città: luce, composizione, editing. Uscite fotografiche incluse.',
                'requirements' => 'Corso di fotografia base o esperienza equivalente.',
                'duration_hours' => 15,
                'status' => 'In programma',
                'start_date' => '2026-08-05',
                'end_date' => '2026-08-20',
                'language' => 'Italiano',
                'delivery_mode' => 'In presenza',
                'category' => 'Fotografia',
                'level' => 'Avanzato',
                'teacher_email' => 'giulia.rossi@example.com'
            ],
            [
                'title' => 'Fotografia con lo Smartphone',
                'description' => 'Scatta foto spettacolari con il tuo telefono. Composizione, luce naturale, editing con app gratuite.',
                'requirements' => 'Nessuno. Basta uno smartphone.',
                'duration_hours' => 8,
                'status' => 'In programma',
                'start_date' => '2026-07-10',
                'end_date' => '2026-07-12',
                'language' => 'Italiano',
                'delivery_mode' => 'In presenza',
                'category' => 'Fotografia',
                'level' => 'Principiante',
                'teacher_email' => 'giulia.rossi@example.com'
            ],
            [
                'title' => 'Gestione del Tempo e Produttività',
                'description' => 'Strategie concrete per migliorare la tua produttività: metodo Pomodoro, time blocking, GTD e strumenti digitali.',
                'requirements' => 'Nessuno.',
                'duration_hours' => 10,
                'status' => 'In programma',
                'start_date' => '2026-09-10',
                'end_date' => '2026-09-20',
                'language' => 'Italiano',
                'delivery_mode' => 'Misto',
                'category' => 'Produttività',
                'level' => 'Principiante',
                'teacher_email' => 'marco.verdi@example.com'
            ],
            [
                'title' => 'Note-Taking Avanzato con Obsidian',
                'description' => 'Costruisci il tuo secondo cervello digitale con Obsidian. Zettelkasten, mappe concettuali, plugin e workflow avanzati.',
                'requirements' => 'Esperienza base con Obsidian o app per note.',
                'duration_hours' => 12,
                'status' => 'In programma',
                'start_date' => '2026-10-01',
                'end_date' => '2026-10-15',
                'language' => 'Italiano',
                'delivery_mode' => 'Online',
                'category' => 'Produttività',
                'level' => 'Intermedio',
                'teacher_email' => 'marco.verdi@example.com'
            ],
            [
                'title' => 'Cucina Italiana Tradizionale',
                'description' => 'Scopri i segreti della cucina italiana con ricette autentiche: pasta fresca, sughi, dolci regionali. Tutto fatto a mano.',
                'requirements' => 'Passione per la cucina.',
                'duration_hours' => 25,
                'status' => 'In programma',
                'start_date' => '2026-10-01',
                'end_date' => '2026-10-31',
                'language' => 'Italiano',
                'delivery_mode' => 'In presenza',
                'category' => 'Cucina',
                'level' => 'Principiante',
                'teacher_email' => 'sara.neri@example.com'
            ],
            [
                'title' => 'Lievito Madre e Pane Artigianale',
                'description' => 'Crea e mantieni il tuo lievito madre. Impara a fare pane, focacce e grissini con tecniche professionali.',
                'requirements' => 'Aver già cucinato almeno una volta.',
                'duration_hours' => 16,
                'status' => 'In programma',
                'start_date' => '2026-11-01',
                'end_date' => '2026-11-20',
                'language' => 'Italiano',
                'delivery_mode' => 'In presenza',
                'category' => 'Cucina',
                'level' => 'Intermedio',
                'teacher_email' => 'sara.neri@example.com'
            ],
            [
                'title' => 'Giardinaggio Sostenibile',
                'description' => 'Tecniche di giardinaggio rispettose dell\'ambiente: compostaggio, orto sinergico, piante perenni e biodiversità.',
                'requirements' => 'Nessuno.',
                'duration_hours' => 18,
                'status' => 'In programma',
                'start_date' => '2026-11-15',
                'end_date' => '2026-12-05',
                'language' => 'Italiano',
                'delivery_mode' => 'In presenza',
                'category' => 'Giardinaggio',
                'level' => 'Principiante',
                'teacher_email' => 'alessandro.russo@example.com'
            ],
            [
                'title' => 'Bonsai: l\'Arte della Miniaturizzazione',
                'description' => 'Introduzione all\'arte del bonsai: scegliere la specie giusta, potatura, rinvaso e cura stagionale.',
                'requirements' => 'Nessuno, ma amore per le piante consigliato.',
                'duration_hours' => 12,
                'status' => 'In programma',
                'start_date' => '2026-09-01',
                'end_date' => '2026-09-20',
                'language' => 'Italiano',
                'delivery_mode' => 'In presenza',
                'category' => 'Giardinaggio',
                'level' => 'Principiante',
                'teacher_email' => 'alessandro.russo@example.com'
            ],
            [
                'title' => 'Acquerello per Principianti',
                'description' => 'Scopri la magia dell\'acquerello: tecniche base, teoria del colore, paesaggi e ritratti. Materiali inclusi.',
                'requirements' => 'Nessuno.',
                'duration_hours' => 14,
                'status' => 'In programma',
                'start_date' => '2026-07-15',
                'end_date' => '2026-08-10',
                'language' => 'Italiano',
                'delivery_mode' => 'In presenza',
                'category' => 'Arte e Disegno',
                'level' => 'Principiante',
                'teacher_email' => 'elena.ferrari@example.com'
            ],
            [
                'title' => 'Illustrazione Digitale con Procreate',
                'description' => 'Padroneggia Procreate su iPad: brush, layer, animazioni e workflow per illustratori professionisti.',
                'requirements' => 'iPad con Procreate installato. Conoscenza base del disegno.',
                'duration_hours' => 20,
                'status' => 'In programma',
                'start_date' => '2026-10-05',
                'end_date' => '2026-11-05',
                'language' => 'Italiano',
                'delivery_mode' => 'Online',
                'category' => 'Arte e Disegno',
                'level' => 'Intermedio',
                'teacher_email' => 'elena.ferrari@example.com'
            ],
            [
                'title' => 'Riparazioni Domestiche di Base',
                'description' => 'Impara a fare le piccole riparazioni in casa: idraulica base, elettricità sicura, montaggio mobili, stucco e verniciatura.',
                'requirements' => 'Nessuno.',
                'duration_hours' => 10,
                'status' => 'In programma',
                'start_date' => '2026-08-20',
                'end_date' => '2026-08-30',
                'language' => 'Italiano',
                'delivery_mode' => 'In presenza',
                'category' => 'Fai Da Te',
                'level' => 'Principiante',
                'teacher_email' => 'luca.bianchi@example.com'
            ],
            [
                'title' => 'Teatro: Improvvisazione e Presenza Scenica',
                'description' => 'Tecniche di improvvisazione teatrale per sviluppare presenza scenica, spontaneità e capacità comunicative.',
                'requirements' => 'Nessuno, solo voglia di mettersi in gioco!',
                'duration_hours' => 20,
                'status' => 'In programma',
                'start_date' => '2026-09-15',
                'end_date' => '2026-10-30',
                'language' => 'Italiano',
                'delivery_mode' => 'In presenza',
                'category' => 'Teatro',
                'level' => 'Principiante',
                'teacher_email' => 'giulia.rossi@example.com'
            ],
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
