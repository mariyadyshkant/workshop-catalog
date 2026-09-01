<?php

use App\Models\Category;
use App\Models\Course;
use App\Models\Level;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    $this->actingAs(User::factory()->create());
});

function coursePayload(array $overrides = []): array
{
    return array_merge([
        'title' => 'Laravel per Principianti',
        'description' => 'Impara le basi di Laravel.',
        'duration_hours' => 20,
        'requirements' => 'Conoscenze base di PHP.',
        'status' => 'In programma',
        'start_date' => '2026-07-01',
        'end_date' => '2026-07-31',
        'language' => 'Italiano',
        'delivery_mode' => 'Online',
        'category_id' => Category::factory()->create()->id,
        'level_id' => Level::factory()->create()->id,
        'teacher_id' => Teacher::factory()->create()->id,
    ], $overrides);
}

test('le rotte dei corsi richiedono autenticazione', function () {
    auth()->logout();

    $this->get(route('courses.index'))->assertRedirect(route('login'));
    $this->post(route('courses.store'), [])->assertRedirect(route('login'));
});

test('la lista e i form dei corsi vengono mostrati', function () {
    Course::factory()->count(2)->create();

    $this->get(route('courses.index'))->assertOk();
    $this->get(route('courses.create'))->assertOk();
});

test('un corso valido viene creato', function () {
    $this->post(route('courses.store'), coursePayload(['title' => 'Corso Nuovo']))
        ->assertRedirect(route('courses.index'));

    expect(Course::where('title', 'Corso Nuovo')->exists())->toBeTrue();
});

test('i campi obbligatori sono validati', function () {
    $this->post(route('courses.store'), [])
        ->assertSessionHasErrors([
            'title', 'description', 'duration_hours', 'requirements',
            'status', 'start_date', 'language', 'delivery_mode',
            'category_id', 'level_id', 'teacher_id',
        ]);
});

test('status fuori dai valori ammessi viene rifiutato', function () {
    $this->post(route('courses.store'), coursePayload(['status' => 'Onlineee']))
        ->assertSessionHasErrors('status');
});

test('delivery_mode fuori dai valori ammessi viene rifiutato', function () {
    $this->post(route('courses.store'), coursePayload(['delivery_mode' => 'Teletrasporto']))
        ->assertSessionHasErrors('delivery_mode');
});

test('end_date deve essere successiva a start_date', function () {
    $this->post(route('courses.store'), coursePayload([
        'start_date' => '2026-07-10',
        'end_date' => '2026-07-01',
    ]))->assertSessionHasErrors('end_date');
});

test('l\'immagine caricata viene salvata su disco public', function () {
    Storage::fake('public');

    $this->post(route('courses.store'), coursePayload([
        'image' => UploadedFile::fake()->image('cover.jpg'),
    ]))->assertRedirect(route('courses.index'));

    $course = Course::latest('id')->first();
    expect($course->image)->not->toBeNull();
    Storage::disk('public')->assertExists($course->image);
});

test('un corso viene aggiornato', function () {
    $course = Course::factory()->create(['title' => 'Vecchio Titolo']);

    $this->put(route('courses.update', $course), coursePayload(['title' => 'Titolo Aggiornato']))
        ->assertRedirect(route('courses.index'));

    expect($course->fresh()->title)->toBe('Titolo Aggiornato');
});

test('destroy fa un soft delete', function () {
    $course = Course::factory()->create();

    $this->delete(route('courses.destroy', $course))
        ->assertRedirect(route('courses.index'));

    expect(Course::find($course->id))->toBeNull();
    expect(Course::withTrashed()->find($course->id))->not->toBeNull();
});
