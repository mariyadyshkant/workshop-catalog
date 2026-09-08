import { useState, useEffect } from 'react'
import { Link } from 'react-router-dom'
import { CourseCard } from '../components/CourseCard'
import { api } from '../lib/api'

export function Home() {
    const [categories, setCategories] = useState([])
    const [featured, setFeatured] = useState([])

    useEffect(() => {
        api.get('/categories')
            .then(res => setCategories(res.data.data))
            .catch(err => console.error(err))

        api.get('/courses', { params: { page: 1 } })
            .then(res => setFeatured(res.data.data.slice(0, 4)))
            .catch(err => console.error(err))
    }, [])

    return (
        <>
            {/* Hero */}
            <div className="home-hero">
                {/* blob decorativi sfocati — elementi separati per poterli animare in seguito */}
                <div className="hero-blob hero-blob-1" aria-hidden="true" />
                <div className="hero-blob hero-blob-2" aria-hidden="true" />
                <div className="hero-blob hero-blob-3" aria-hidden="true" />
                <div className="container py-5 text-center">
                    <h1 className="hero-title">Impara qualcosa di nuovo con Corsorama</h1>
                    <p className="hero-subtitle mx-auto" style={{ maxWidth: '620px' }}>
                        Workshop pratici tenuti da professionisti: programmazione, fotografia,
                        cucina, arte e molto altro. Trova il corso giusto per te.
                    </p>
                    <Link
                        to="/courses"
                        className="btn-card-detail d-inline-block mt-4"
                        style={{ padding: '0.6rem 1.6rem' }}
                    >
                        Esplora il catalogo →
                    </Link>
                </div>
            </div>

            <div className="container py-5">
                {/* Categorie */}
                <section className="mb-5">
                    <h2 className="h4 fw-bold mb-3">Categorie</h2>
                    {categories.length === 0 ? (
                        <p className="text-muted">Nessuna categoria disponibile.</p>
                    ) : (
                        <div className="d-flex flex-wrap gap-2">
                            {categories.map(c => (
                                <Link key={c.id} to="/courses" className="category-pill">
                                    {c.name}
                                </Link>
                            ))}
                        </div>
                    )}
                </section>

                {/* Corsi in evidenza */}
                <section>
                    <div className="d-flex justify-content-between align-items-center mb-3">
                        <h2 className="h4 fw-bold mb-0">Corsi in evidenza</h2>
                        <Link to="/courses" className="link-vedi-tutti">Vedi tutti →</Link>
                    </div>
                    {featured.length === 0 ? (
                        <p className="text-muted">Caricamento…</p>
                    ) : (
                        <div className="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
                            {featured.map(course => (
                                <div className="col" key={course.id}>
                                    <CourseCard course={course} />
                                </div>
                            ))}
                        </div>
                    )}
                </section>
            </div>
        </>
    )
}
