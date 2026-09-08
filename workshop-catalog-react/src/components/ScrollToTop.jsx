import { useEffect } from 'react'
import { useLocation } from 'react-router-dom'

// Riporta lo scroll in cima a ogni cambio di path
export function ScrollToTop() {
    const { pathname } = useLocation()

    useEffect(() => {
        window.scrollTo(0, 0)
    }, [pathname])

    return null
}
