# Corso Rama — Frontend (React)
 
Catalogo pubblico di **Corso Rama**, un sito per la scoperta e consultazione di corsi. Consuma l'API REST esposta dal backend Laravel in un repository separato: [workshop-catalog](https://github.com/mariyadyshkant/workshop-catalog) (cartella `workshop-catalog-laravel`).
 
## Cosa fa
 
- **Home** con elenco corsi, filtro per categoria deep-linkabile (link diretti a una categoria specifica) e ricerca
- **Pagina di dettaglio corso** — informazioni complete (docente, durata, livello, modalità, città per i corsi in presenza, posti liberi), con un bottone "Prenota" attualmente segnaposto in vista del sistema di prenotazione futuro
- Link al login del backoffice per l'accesso amministrativo
## Stack
 
- **React 19** + **React Router 7**
- **Vite** come build tool
- **Axios** per le chiamate all'API
- **Motion** (Framer Motion) per le animazioni — fade-in/slide-up in hero, transizioni sulle card corso
- **lucide-react** per le icone
## Configurazione
 
```bash
npm install
cp .env.example .env   # imposta VITE_API_URL con l'URL del backend
npm run dev
```
 
`VITE_API_URL` deve puntare all'endpoint `/api` del backend Laravel (es. `http://localhost:8000/api` in locale, l'URL Railway in produzione).
 
## Deploy
 
In produzione gira su **Netlify**, con redirect SPA configurati (`_redirects`) per gestire il routing lato client di React Router.
 
## Prossimi sviluppi
 
Il bottone "Prenota" sulla pagina di dettaglio è per ora solo un'anticipazione visiva: l'obiettivo è costruire un vero sistema di autenticazione utente che permetta di registrarsi e prenotare un posto in un corso direttamente da qui.
 

# Corso Rama — Backend (Laravel)
 
Backend e pannello amministrativo di **Corso Rama**, un catalogo corsi full-stack. Questo repository espone l'API pubblica consumata dal frontend React e gestisce l'inserimento/modifica dei corsi tramite un backoffice ad accesso riservato.
 
Il frontend pubblico vive in un repository separato: [workshop-catalog-react](https://github.com/mariyadyshkant/workshop-catalog).
 
## Cosa fa
 
- **API pubblica** (`/api/courses`, `/api/categories`, `/api/levels`) — elenco corsi con ricerca full-text su titolo/descrizione, filtro per categoria/livello/modalità di erogazione, paginazione
- **Backoffice** (`/dashboard`, protetto da autenticazione + middleware admin) — CRUD completo su corsi, categorie, livelli e docenti, con upload immagine copertina
- **Autenticazione** via Laravel Breeze (login/registrazione classici); solo gli utenti marcati `is_admin` accedono al backoffice, gli altri restano sulla dashboard base
## Modello dati
 
Quattro entità principali:
 
- **Corso** — titolo, descrizione, durata in ore, requisiti, date inizio/fine, lingua, modalità di erogazione (online/in presenza), città (per i corsi in presenza), posti liberi, immagine; soft delete
- **Categoria**, **Livello**, **Docente** — anagrafiche collegate al corso tramite relazioni `belongsTo`
## Validazione
 
Ogni entità amministrabile ha una propria classe `FormRequest` dedicata (`app/Http/Requests/Admin/`), invece di validazione inline nei controller — regole centralizzate e riutilizzabili tra creazione e modifica.
 
## Stack
 
- **Laravel 12** (PHP 8.2)
- **SQLite** come database (scelta per semplicità di deploy: un singolo file, nessun server DB separato da gestire)
- **Breeze** per l'autenticazione
- Frontend Blade per il backoffice, API REST (Resource classes) per il frontend pubblico
## Deploy
 
In produzione gira su **Railway**, come container Docker:
 
- Build a due stage: gli asset Vite del backoffice vengono compilati in uno stage Node separato, poi copiati nell'immagine PHP finale (immagine più leggera, niente Node a runtime)
- Il file SQLite vive su un volume persistente montato su `/data`
- All'avvio: cache della configurazione, migrazioni automatiche (`migrate --force`), `storage:link`, poi il server Laravel
- CORS configurato via variabile d'ambiente (`CORS_ALLOWED_ORIGINS`) per accettare richieste dal frontend Netlify
## Sviluppo locale
 
```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
npm install && npm run build   # asset del backoffice (Blade + Breeze)
php artisan serve
```
 
## Prossimi sviluppi
 
Il backoffice e l'API sono lo stato attuale; l'obiettivo successivo è un sistema di autenticazione e prenotazione lato utente pubblico, che permetta a chi consulta il catalogo di registrarsi e prenotare direttamente un posto in un corso.
 
## Autrice
 
Mariya Dyshkant
[Portfolio](https://mariyadyshkant.com) · [LinkedIn](https://linkedin.com/in/mariya-dyshkant-45bb411ba)
 

 
