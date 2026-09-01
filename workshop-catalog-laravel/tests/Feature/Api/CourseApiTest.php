<?php

use App\Models\Category;
use App\Models\Course;
use App\Models\Level;

test('GET /api/courses restituisce una risposta paginata', function () {
    Course::factory()->count(15)->create();

    $response = $this->getJson('/api/courses')->assertOk();

    $response->assertJsonStructure([
        'data' => [['id', 'title', 'category' => ['id', 'name'], 'level' => ['id', 'name'], 'teacher' => ['id', 'name']]],
        'links',
        'meta' => ['current_page', 'last_page', 'per_page', 'total'],
    ]);

    expect($response->json('meta.per_page'))->toBe(12)
        ->and($response->json('meta.total'))->toBe(15)
        ->and($response->json('data'))->toHaveCount(12);
});

test('la Resource non espone i campi interni', function () {
    Course::factory()->create();

    $course = $this->getJson('/api/courses')->json('data.0');

    expect($course)->not->toHaveKeys(['created_at', 'updated_at', 'deleted_at', 'category_id', 'level_id', 'teacher_id']);
});

test('i corsi soft-deleted non compaiono', function () {
    $visible = Course::factory()->create();
    Course::factory()->create()->delete();

    $ids = $this->getJson('/api/courses')->json('data.*.id');

    expect($ids)->toBe([$visible->id]);
});

test('filtro per category_id', function () {
    $cat = Category::factory()->create();
    Course::factory()->create(['category_id' => $cat->id]);
    Course::factory()->count(3)->create();

    $data = $this->getJson('/api/courses?category_id=' . $cat->id)->json('data');

    expect($data)->toHaveCount(1)
        ->and($data[0]['category']['id'])->toBe($cat->id);
});

test('filtro per delivery_mode', function () {
    Course::factory()->create(['delivery_mode' => 'Online']);
    Course::factory()->create(['delivery_mode' => 'In presenza']);

    $data = $this->getJson('/api/courses?delivery_mode=Online')->json('data');

    expect($data)->toHaveCount(1)
        ->and($data[0]['delivery_mode'])->toBe('Online');
});

test('ricerca per titolo', function () {
    Course::factory()->create(['title' => 'Corso di Fotografia Analogica']);
    Course::factory()->create(['title' => 'Introduzione a Vue']);

    $data = $this->getJson('/api/courses?search=fotografia')->json('data');

    expect($data)->toHaveCount(1)
        ->and($data[0]['title'])->toBe('Corso di Fotografia Analogica');
});

test('GET /api/courses/{id} restituisce il singolo corso avvolto in data', function () {
    $course = Course::factory()->create();

    $this->getJson("/api/courses/{$course->id}")
        ->assertOk()
        ->assertJsonPath('data.id', $course->id)
        ->assertJsonPath('data.title', $course->title)
        ->assertJsonStructure(['data' => ['id', 'title', 'category', 'level', 'teacher']]);
});

test('GET /api/courses/{id} inesistente restituisce 404', function () {
    $this->getJson('/api/courses/999999')->assertNotFound();
});

test('GET /api/categories e /api/levels restituiscono id e name in data', function () {
    Category::factory()->count(2)->create();
    Level::factory()->count(2)->create();

    $this->getJson('/api/categories')
        ->assertOk()
        ->assertJsonStructure(['data' => [['id', 'name']]]);

    $this->getJson('/api/levels')
        ->assertOk()
        ->assertJsonStructure(['data' => [['id', 'name']]]);
});
