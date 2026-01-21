<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Fai Da Te',
            'Cucina',
            'Giardinaggio',
            'Fotografia',
            'Programmazione',
            'Arte e Disegno',
            'Teatro',
            'Produttività',
        ];
        foreach ($categories as $category) {
            Category::create(['name' => $category]);
        }
    }
}
