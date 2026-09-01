<?php

use App\Models\User;

$adminRoutes = [
    ['get', 'courses.index'],
    ['get', 'categories.index'],
    ['get', 'levels.index'],
    ['get', 'teachers.index'],
];

test('un utente non autenticato viene rediretto al login', function ($method, $route) {
    $this->{$method}(route($route))->assertRedirect(route('login'));
})->with($adminRoutes);

test('un utente autenticato ma non admin riceve 403', function ($method, $route) {
    $this->actingAs(User::factory()->create())
        ->{$method}(route($route))
        ->assertForbidden();
})->with($adminRoutes);

test('un utente admin accede al backoffice', function ($method, $route) {
    $this->actingAs(User::factory()->admin()->create())
        ->{$method}(route($route))
        ->assertOk();
})->with($adminRoutes);

test('la registrazione crea un utente non admin', function () {
    $this->post(route('register'), [
        'name' => 'Mario',
        'email' => 'mario@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    expect(User::where('email', 'mario@example.com')->first()->is_admin)->toBeFalse();
});

test('is_admin non è impostabile dalla richiesta di registrazione', function () {
    $this->post(route('register'), [
        'name' => 'Furbo',
        'email' => 'furbo@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
        'is_admin' => 1,
    ]);

    expect(User::where('email', 'furbo@example.com')->first()->is_admin)->toBeFalse();
});
