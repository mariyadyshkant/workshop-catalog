import axios from 'axios'

const baseURL = import.meta.env.VITE_API_URL

export const api = axios.create({ baseURL })

// baseURL è ".../api" — per gli asset serve la root senza "/api"
const storageBase = baseURL.replace(/\/api\/?$/, '')

export function imageUrl(path) {
    return `${storageBase}/storage/${path}`
}
