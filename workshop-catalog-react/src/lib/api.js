import axios from 'axios'

const baseURL = import.meta.env.VITE_API_URL

export const api = axios.create({ baseURL })

// baseURL è ".../api" — per asset e pagine Laravel serve la root senza "/api"
const storageBase = baseURL.replace(/\/api\/?$/, '')

export function imageUrl(path) {
    return `${storageBase}/storage/${path}`
}

// Login del backoffice Laravel. Per ora è solo per l'admin; se in futuro
// arriva un login utenti "vero" nella SPA, questo link cambierà rotta.
export const loginUrl = `${storageBase}/login`
