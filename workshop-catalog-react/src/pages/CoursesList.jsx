import { useState, useEffect } from 'react'
import { CourseCard } from '../components/CourseCard'
import axios from 'axios'

const API = import.meta.env.VITE_API_URL

export function CoursesList() {
    const [courses, setCourses] = useState([])
    const [meta, setMeta] = useState(null)
    const [categories, setCategories] = useState([])
    const [levels, setLevels] = useState([])
    const [loading, setLoading] = useState(true)
    const [error, setError] = useState(false)

    const [search, setSearch] = useState('')
    const [categoryId, setCategoryId] = useState('')
    const [levelId, setLevelId] = useState('')
    const [deliveryMode, setDeliveryMode] = useState('')
    const [page, setPage] = useState(1)
    const [retryCount, setRetryCount] = useState(0)

    useEffect(() => {
        Promise.all([
            axios.get(`${API}/categories`),
            axios.get(`${API}/levels`),
        ]).then(([catRes, levRes]) => {
            setCategories(catRes.data.data)
            setLevels(levRes.data.data)
        })
    }, [])

    // Torna alla prima pagina ogni volta che cambia un filtro
    useEffect(() => {
        setPage(1)
    }, [search, categoryId, levelId, deliveryMode])

    useEffect(() => {
        setLoading(true)
        setError(false)
        const params = { page }
        if (search) params.search = search
        if (categoryId) params.category_id = categoryId
        if (levelId) params.level_id = levelId
        if (deliveryMode) params.delivery_mode = deliveryMode

        axios.get(`${API}/courses`, { params })
            .then(response => {
                setCourses(response.data.data)
                setMeta(response.data.meta)
            })
            .catch(error => {
                console.error(error)
                setError(true)
            })
            .finally(() => setLoading(false))
    }, [search, categoryId, levelId, deliveryMode, page, retryCount])

    const hasFilters = search || categoryId || levelId || deliveryMode

    function resetFilters() {
        setSearch('')
        setCategoryId('')
        setLevelId('')
        setDeliveryMode('')
    }

    return (
        <>
            {/* Hero */}
            <div className="hero-section">
                <div className="container py-5">
                    <h1 className="hero-title">Scopri il tuo prossimo workshop</h1>
                    <p className="hero-subtitle">
                        {meta?.total > 0 && !loading
                            ? `${meta.total} corsi disponibili — trova quello che fa per te`
                            : 'Esplora il catalogo completo dei workshop disponibili'}
                    </p>

                    {/* Barra di ricerca */}
                    <div className="search-bar-wrapper mt-4">
                        <span className="search-icon">🔍</span>
                        <input
                            type="text"
                            className="search-input"
                            placeholder="Cerca un corso..."
                            value={search}
                            onChange={e => setSearch(e.target.value)}
                        />
                        {search && (
                            <button className="search-clear" onClick={() => setSearch('')}>✕</button>
                        )}
                    </div>
                </div>
            </div>

            <div className="container py-4">
                {/* Filtri */}
                <div className="filters-row mb-4">
                    <select
                        className="filter-select"
                        value={categoryId}
                        onChange={e => setCategoryId(e.target.value)}
                    >
                        <option value="">Tutte le categorie</option>
                        {categories.map(c => (
                            <option key={c.id} value={c.id}>{c.name}</option>
                        ))}
                    </select>

                    <select
                        className="filter-select"
                        value={levelId}
                        onChange={e => setLevelId(e.target.value)}
                    >
                        <option value="">Tutti i livelli</option>
                        {levels.map(l => (
                            <option key={l.id} value={l.id}>{l.name}</option>
                        ))}
                    </select>

                    <select
                        className="filter-select"
                        value={deliveryMode}
                        onChange={e => setDeliveryMode(e.target.value)}
                    >
                        <option value="">Tutte le modalità</option>
                        <option value="Online">Online</option>
                        <option value="In presenza">In presenza</option>
                        <option value="Misto">Misto</option>
                    </select>

                    {hasFilters && (
                        <button className="btn-reset-filters" onClick={resetFilters}>
                            ✕ Azzera filtri
                        </button>
                    )}
                </div>

                {/* Risultati */}
                {loading ? (
                    <div className="text-center py-5">
                        <div className="spinner-border text-primary" role="status" />
                        <p className="mt-3 text-muted">Caricamento corsi...</p>
                    </div>
                ) : error ? (
                    <div className="empty-state">
                        <p className="empty-icon">⚠️</p>
                        <h5>Impossibile caricare i corsi</h5>
                        <p className="text-muted">Controlla la connessione o riprova tra poco.</p>
                        <button className="btn btn-outline-primary btn-sm mt-2" onClick={() => setRetryCount(c => c + 1)}>
                            Riprova
                        </button>
                    </div>
                ) : courses.length === 0 ? (
                    <div className="empty-state">
                        <p className="empty-icon">🔎</p>
                        <h5>Nessun corso trovato</h5>
                        <p className="text-muted">Prova a modificare i filtri o la ricerca.</p>
                        {hasFilters && (
                            <button className="btn btn-outline-primary btn-sm mt-2" onClick={resetFilters}>
                                Azzera filtri
                            </button>
                        )}
                    </div>
                ) : (
                    <>
                        <div className="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                            {courses.map(course => (
                                <div className="col" key={course.id}>
                                    <CourseCard course={course} />
                                </div>
                            ))}
                        </div>

                        {meta && meta.last_page > 1 && (
                            <div className="d-flex justify-content-center align-items-center gap-3 mt-4">
                                <button
                                    className="btn btn-outline-secondary btn-sm"
                                    disabled={meta.current_page <= 1}
                                    onClick={() => setPage(p => p - 1)}
                                >
                                    ← Precedente
                                </button>
                                <span className="text-muted small">
                                    Pagina {meta.current_page} di {meta.last_page}
                                </span>
                                <button
                                    className="btn btn-outline-secondary btn-sm"
                                    disabled={meta.current_page >= meta.last_page}
                                    onClick={() => setPage(p => p + 1)}
                                >
                                    Successiva →
                                </button>
                            </div>
                        )}
                    </>
                )}
            </div>
        </>
    )
}
