# Corsorama — Backend (Laravel)

Backend e pannello di amministrazione di [Corsorama](../README.md): espone l'API REST pubblica consumata dal frontend React e gestisce corsi, categorie, livelli e docenti da un backoffice riservato.

## Cosa fa

- **API pubblica** (`/api/courses`, `/api/courses/{id}`, `/api/categories`, `/api/levels`): ricerca per titolo e descrizione, filtri per categoria, livello e modalità, paginazione.
- **Backoffice** (`/dashboard`, protetto da autenticazione e dal middleware `admin`): CRUD su corsi, categorie, livelli e docenti, con upload della copertina e soft delete dei corsi.
- **Autenticazione** con Laravel Breeze; accedono al backoffice solo gli utenti con `is_admin`.

## Struttura

- `app/Http/Controllers/Admin` e `app/Http/Controllers/Api`: controller del backoffice e dell'API.
- `app/Http/Requests/Admin`: una classe Form Request per ogni entità.
- `app/Http/Resources`: API Resource per le risposte JSON.
- `tests/Feature`: test Pest (Admin, Api, Auth).

## Stack

PHP 8.2 · Laravel 12 · Laravel Breeze · SQLite · Pest · Vite (asset Blade del backoffice)

## Sviluppo locale

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
npm install && npm run build
php artisan serve
```

Il seeder crea corsi di esempio e un utente amministratore di sviluppo (`admin@example.com`, password `password`): **da cambiare o rimuovere in produzione**.

## Test

```bash
php artisan test
```

## Deploy

Su Railway, come container Docker a due stage. SQLite su volume persistente montato su `/data`; all'avvio: cache della configurazione, `migrate --force`, `storage:link`. CORS configurato con `CORS_ALLOWED_ORIGINS`.
