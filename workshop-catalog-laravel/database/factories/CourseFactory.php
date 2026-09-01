<?php

namespace Database\Factories;

use App\Http\Requests\Admin\CourseRequest;
use App\Models\Category;
use App\Models\Level;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    public function definition(): array
    {
        $start = fake()->dateTimeBetween('+1 week', '+2 months');

        return [
            'title' => fake()->sentence(4),
            'description' => fake()->paragraph(),
            'duration_hours' => fake()->numberBetween(4, 80),
            'requirements' => fake()->sentence(),
            'status' => fake()->randomElement(CourseRequest::STATUSES),
            'start_date' => $start->format('Y-m-d'),
            'end_date' => (clone $start)->modify('+2 weeks')->format('Y-m-d'),
            'language' => 'Italiano',
            'delivery_mode' => fake()->randomElement(CourseRequest::DELIVERY_MODES),
            'image' => null,
            'category_id' => Category::factory(),
            'level_id' => Level::factory(),
            'teacher_id' => Teacher::factory(),
        ];
    }
}
