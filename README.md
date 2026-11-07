# Corsorama

Catalogo di corsi full-stack: un **backend Laravel** con pannello di amministrazione e API REST pubblica, e un **frontend React** che la consuma per mostrare il catalogo ai visitatori.

Progetto finale della specializzazione PHP/Laravel di Boolean.

**Demo online:** [corsorama.mariyadyshkant.com](https://corsorama.mariyadyshkant.com) · **Portfolio:** [mariyadyshkant.com](https://mariyadyshkant.com)

## Cosa fa

- **Catalogo pubblico:** elenco dei corsi con ricerca per titolo e descrizione, filtri per categoria, livello e modalità (online o in presenza), paginazione e pagina di dettaglio (docente, durata, livello, città per i corsi in presenza, posti liberi).
- **Backoffice:** pannello riservato agli amministratori, con CRUD completo su corsi, categorie, livelli e docenti, upload dell'immagine di copertina e eliminazione reversibile (soft delete) dei corsi.
- **Autenticazione:** login e registrazione con Laravel Breeze; solo gli utenti con `is_admin` accedono al backoffice.

## Architettura

Monorepo con due applicazioni indipendenti:

```
workshop-catalog/
├── workshop-catalog-laravel/   backend: API REST + backoffice (Laravel 12)
└── workshop-catalog-react/     frontend pubblico (React 19)
```

```
Browser ──► Frontend React (Netlify) ──► API REST /api (Laravel, Railway) ──► SQLite
                                         Backoffice Blade /dashboard ◄── amministratori
```

Dettagli in [`workshop-catalog-laravel`](workshop-catalog-laravel) e [`workshop-catalog-react`](workshop-catalog-react).

## Modello dati

Quattro entità collegate: **Corso**, **Categoria**, **Livello**, **Docente**. Un corso appartiene a una categoria, a un livello e a un docente. I corsi hanno date di inizio e fine, lingua, modalità di erogazione, città e posti liberi (per quelli in presenza), immagine e soft delete.

## Stack

| Parte | Tecnologie |
|---|---|
| Backend | PHP 8.2, Laravel 12, Laravel Breeze, Form Request, API Resource, SQLite |
| Test | Pest (test Feature su backoffice, API e autenticazione) |
| Frontend | React 19, React Router 7, Vite, Axios, Motion, lucide-react |
| Deploy | Railway (backend in Docker, volume persistente per SQLite), Netlify (frontend) |

## API pubblica

| Metodo | Endpoint | Descrizione |
|---|---|---|
| GET | `/api/courses` | Elenco corsi (12 per pagina). Parametri: `search`, `category_id`, `level_id`, `delivery_mode` |
| GET | `/api/courses/{id}` | Dettaglio di un corso |
| GET | `/api/categories` | Elenco categorie |
| GET | `/api/levels` | Elenco livelli |

## Scelte progettuali

- **Validazione centralizzata:** ogni entità amministrabile ha una propria classe Form Request, invece di regole scritte nei controller.
- **API Resource:** la forma delle risposte JSON è definita in classi dedicate, separata dai modelli.
- **Accesso al backoffice:** middleware `admin` sopra l'autenticazione.
- **SQLite:** scelta per semplicità di deploy, un solo file su volume persistente e nessun server di database da gestire.
- **Frontend separato:** il catalogo pubblico è indipendente dal backoffice e comunica solo tramite API, con CORS configurato per il dominio del frontend.

## Test

Il backend è coperto da test automatici con Pest su backoffice (accesso e CRUD di corsi, categorie, livelli, docenti), API dei corsi e autenticazione.

```bash
cd workshop-catalog-laravel
php artisan test
```

## Avvio in locale

```bash
# Backend
cd workshop-catalog-laravel
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed   # dati di esempio e utente admin di sviluppo
npm install && npm run build
php artisan serve            # http://localhost:8000

# Frontend (in un altro terminale)
cd workshop-catalog-react
npm install
echo "VITE_API_URL=http://localhost:8000/api" > .env
npm run dev
```

## Deploy

- **Backend su Railway:** immagine Docker a due stage (gli asset Vite del backoffice si compilano in uno stage Node, poi si copiano nell'immagine PHP finale); database SQLite su un volume montato su `/data`; all'avvio cache della configurazione, migrazioni automatiche (`migrate --force`) e `storage:link`.
- **Frontend su Netlify:** build Vite con fallback SPA, così il refresh su `/courses/5` non dà 404. CORS lato backend via `CORS_ALLOWED_ORIGINS`.

## Prossimi sviluppi

Registrazione degli utenti pubblici e prenotazione di un posto in un corso. Il bottone «Prenota» nella pagina di dettaglio è per ora solo un'anteprima della funzione.

## Autrice

Mariya Dyshkant · [Portfolio](https://mariyadyshkant.com) · [LinkedIn](https://www.linkedin.com/in/mariyadyshkant/)
