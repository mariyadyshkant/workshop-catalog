<?php

use App\Models\Teacher;
use App\Models\User;

beforeEach(function () {
    $this->actingAs(User::factory()->admin()->create());
});

test('la lista insegnanti richiede autenticazione', function () {
    auth()->logout();

    $this->get(route('teachers.index'))->assertRedirect(route('login'));
});

test('la lista insegnanti viene mostrata', function () {
    Teacher::factory()->count(3)->create();

    $this->get(route('teachers.index'))->assertOk();
});

test('un insegnante valido viene creato', function () {
    $data = [
        'name' => 'Luca',
        'surname' => 'Bianchi',
        'email' => 'luca.bianchi@example.com',
    ];

    $this->post(route('teachers.store'), $data)
        ->assertRedirect(route('teachers.index'));

    expect(Teacher::where('email', 'luca.bianchi@example.com')->exists())->toBeTrue();
});

test('nome, cognome ed email sono obbligatori', function () {
    $this->post(route('teachers.store'), [])
        ->assertSessionHasErrors(['name', 'surname', 'email']);
});

test('l\'email deve essere valida e unica', function () {
    $this->post(route('teachers.store'), [
        'name' => 'A', 'surname' => 'B', 'email' => 'non-una-email',
    ])->assertSessionHasErrors('email');

    Teacher::factory()->create(['email' => 'dup@example.com']);
    $this->post(route('teachers.store'), [
        'name' => 'A', 'surname' => 'B', 'email' => 'dup@example.com',
    ])->assertSessionHasErrors('email');
});

test('aggiornare un insegnante con la propria stessa email non dà errore di unicità', function () {
    $teacher = Teacher::factory()->create(['email' => 'mario@example.com']);

    $this->put(route('teachers.update', $teacher), [
        'name' => $teacher->name,
        'surname' => $teacher->surname,
        'email' => 'mario@example.com',
    ])->assertRedirect(route('teachers.index'))->assertSessionHasNoErrors();
});

test('un insegnante viene eliminato', function () {
    $teacher = Teacher::factory()->create();

    $this->delete(route('teachers.destroy', $teacher))
        ->assertRedirect(route('teachers.index'));

    expect(Teacher::find($teacher->id))->toBeNull();
});
