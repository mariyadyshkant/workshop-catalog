<?php

use App\Models\Category;
use App\Models\User;

test('un utente non autenticato non può creare una categoria', function () {
    $this->post(route('categories.store'), ['name' => 'Test'])
        ->assertRedirect(route('login'));
});

test('la validazione rifiuta un nome mancante', function () {
    $this->actingAs(User::factory()->create())
        ->post(route('categories.store'), ['name' => ''])
        ->assertSessionHasErrors('name');
});

test('la validazione rifiuta un nome duplicato in creazione', function () {
    Category::create(['name' => 'Fotografia']);

    $this->actingAs(User::factory()->create())
        ->post(route('categories.store'), ['name' => 'Fotografia'])
        ->assertSessionHasErrors('name');
});

test('aggiornare una categoria con il proprio stesso nome non genera errore di unicità', function () {
    $category = Category::create(['name' => 'Fotografia']);

    $this->actingAs(User::factory()->create())
        ->put(route('categories.update', $category), ['name' => 'Fotografia'])
        ->assertRedirect(route('categories.index'))
        ->assertSessionHasNoErrors();
});

test('aggiornare una categoria con il nome di un\'altra categoria genera errore di unicità', function () {
    Category::create(['name' => 'Fotografia']);
    $cucina = Category::create(['name' => 'Cucina']);

    $this->actingAs(User::factory()->create())
        ->put(route('categories.update', $cucina), ['name' => 'Fotografia'])
        ->assertSessionHasErrors('name');
});

test('una categoria valida viene creata correttamente', function () {
    $this->actingAs(User::factory()->create())
        ->post(route('categories.store'), ['name' => 'Teatro'])
        ->assertRedirect(route('categories.index'));

    expect(Category::where('name', 'Teatro')->exists())->toBeTrue();
});
