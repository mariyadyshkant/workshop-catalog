<?php

use App\Models\Category;
use App\Models\User;

beforeEach(function () {
    $this->actingAs(User::factory()->create());
});

test('un utente non autenticato viene rediretto al login', function () {
    auth()->logout();

    $this->get(route('categories.index'))->assertRedirect(route('login'));
    $this->post(route('categories.store'), ['name' => 'X'])->assertRedirect(route('login'));
});

test('la lista categorie viene mostrata', function () {
    Category::factory()->count(3)->create();

    $this->get(route('categories.index'))->assertOk();
});

test('una categoria valida viene creata', function () {
    $this->post(route('categories.store'), ['name' => 'Fotografia'])
        ->assertRedirect(route('categories.index'));

    expect(Category::where('name', 'Fotografia')->exists())->toBeTrue();
});

test('il nome è obbligatorio', function () {
    $this->post(route('categories.store'), ['name' => ''])
        ->assertSessionHasErrors('name');
});

test('il nome deve essere unico in creazione', function () {
    Category::factory()->create(['name' => 'Cucina']);

    $this->post(route('categories.store'), ['name' => 'Cucina'])
        ->assertSessionHasErrors('name');
});

test('aggiornare una categoria con il proprio stesso nome non dà errore di unicità', function () {
    $category = Category::factory()->create(['name' => 'Cucina']);

    $this->put(route('categories.update', $category), ['name' => 'Cucina'])
        ->assertRedirect(route('categories.index'))
        ->assertSessionHasNoErrors();
});

test('aggiornare una categoria con il nome di un\'altra dà errore di unicità', function () {
    Category::factory()->create(['name' => 'Cucina']);
    $altra = Category::factory()->create(['name' => 'Teatro']);

    $this->put(route('categories.update', $altra), ['name' => 'Cucina'])
        ->assertSessionHasErrors('name');
});

test('una categoria viene eliminata', function () {
    $category = Category::factory()->create();

    $this->delete(route('categories.destroy', $category))
        ->assertRedirect(route('categories.index'));

    expect(Category::find($category->id))->toBeNull();
});
