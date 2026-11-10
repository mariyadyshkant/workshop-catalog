# Corsorama — Frontend (React)

Catalogo pubblico di [Corsorama](../README.md). Consuma l'API REST del backend Laravel, che si trova nell'altra cartella del repository: [`workshop-catalog-laravel`](../workshop-catalog-laravel).

## Cosa fa

- **Home** con elenco dei corsi, ricerca e filtro per categoria (con link diretti a una categoria).
- **Pagina di dettaglio** con docente, durata, livello, modalità, città per i corsi in presenza e posti liberi. Il bottone «Prenota» è un segnaposto in vista del sistema di prenotazione.
- Link al login del backoffice per l'accesso amministrativo.

## Stack

React 19 · React Router 7 · Vite · Axios · Motion (animazioni) · lucide-react (icone)

## Avvio in locale

```bash
npm install
echo "VITE_API_URL=http://localhost:8000/api" > .env   # URL del backend
npm run dev
```

`VITE_API_URL` deve puntare all'endpoint `/api` del backend (es. `http://localhost:8000/api` in locale, l'URL Railway in produzione).

## Deploy

Su Netlify, con fallback SPA (`netlify.toml` e `_redirects`) per gestire il routing lato client.
