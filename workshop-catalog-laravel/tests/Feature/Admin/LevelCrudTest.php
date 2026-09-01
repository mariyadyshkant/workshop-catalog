<?php

use App\Models\Level;
use App\Models\User;

beforeEach(function () {
    $this->actingAs(User::factory()->create());
});

test('la lista livelli richiede autenticazione', function () {
    auth()->logout();

    $this->get(route('levels.index'))->assertRedirect(route('login'));
});

test('la lista livelli viene mostrata', function () {
    Level::factory()->count(3)->create();

    $this->get(route('levels.index'))->assertOk();
});

test('un livello valido viene creato', function () {
    $this->post(route('levels.store'), ['name' => 'Principiante'])
        ->assertRedirect(route('levels.index'));

    expect(Level::where('name', 'Principiante')->exists())->toBeTrue();
});

test('il nome del livello è obbligatorio e unico', function () {
    $this->post(route('levels.store'), ['name' => ''])->assertSessionHasErrors('name');

    Level::factory()->create(['name' => 'Avanzato']);
    $this->post(route('levels.store'), ['name' => 'Avanzato'])->assertSessionHasErrors('name');
});

test('un livello viene aggiornato', function () {
    $level = Level::factory()->create(['name' => 'Base']);

    $this->put(route('levels.update', $level), ['name' => 'Intermedio'])
        ->assertRedirect(route('levels.index'));

    expect($level->fresh()->name)->toBe('Intermedio');
});

test('un livello viene eliminato', function () {
    $level = Level::factory()->create();

    $this->delete(route('levels.destroy', $level))
        ->assertRedirect(route('levels.index'));

    expect(Level::find($level->id))->toBeNull();
});
