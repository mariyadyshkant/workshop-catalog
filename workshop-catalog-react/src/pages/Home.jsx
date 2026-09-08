import { useState, useEffect } from 'react'
import { Link } from 'react-router-dom'
import { motion, useReducedMotion } from 'motion/react'
import { CourseCard } from '../components/CourseCard'
import { api } from '../lib/api'

// Fade-in + slide-up staggerato per il contenuto dell'hero (titolo, poi sottotitolo, poi bottone)
const heroContainer = {
    hidden: {},
    show: { transition: { staggerChildren: 0.12, delayChildren: 0.05 } },
}
const heroItem = {
    hidden: { opacity: 0, y: 16 },
    show: { opacity: 1, y: 0, transition: { duration: 0.35, ease: 'easeOut' } },
}

// Movimento lento e continuo dei blob di sfondo (loop, sobrio ma percettibile)
const blobs = [
    { cls: 'hero-blob-1', anim: { x: [0, 60, 0], y: [0, 40, 0], scale: [1, 1.12, 1] }, duration: 16 },
    { cls: 'hero-blob-2', anim: { x: [0, -52, 0], y: [0, -44, 0], scale: [1, 1.15, 1] }, duration: 20 },
    { cls: 'hero-blob-3', anim: { x: [0, -75, 0], y: [0, 46, 0], scale: [1, 1.16, 1] }, duration: 13 },
]

export function Home() {
    const [categories, setCategories] = useState([])
    const [featured, setFeatured] = useState([])
    const reduceMotion = useReducedMotion()

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
                {/* blob decorativi sfocati — elementi separati, in movimento lento e continuo */}
                {blobs.map(b => (
                    <motion.div
                        key={b.cls}
                        className={`hero-blob ${b.cls}`}
                        aria-hidden="true"
                        animate={reduceMotion ? undefined : b.anim}
                        transition={reduceMotion ? undefined : {
                            duration: b.duration,
                            repeat: Infinity,
                            repeatType: 'mirror',
                            ease: 'easeInOut',
                        }}
                    />
                ))}

                <motion.div
                    className="container py-5 text-center"
                    variants={heroContainer}
                    initial={reduceMotion ? false : 'hidden'}
                    animate="show"
                >
                    <motion.h1 className="hero-title" variants={heroItem}>
                        Impara qualcosa di nuovo con Corsorama
                    </motion.h1>
                    <motion.p className="hero-subtitle mx-auto" style={{ maxWidth: '620px' }} variants={heroItem}>
                        Workshop pratici tenuti da professionisti: programmazione, fotografia,
                        cucina, arte e molto altro. Trova il corso giusto per te.
                    </motion.p>
                    <motion.div className="mt-4" variants={heroItem}>
                        <Link
                            to="/courses"
                            className="btn-card-detail d-inline-block"
                            style={{ padding: '0.6rem 1.6rem' }}
                        >
                            Esplora il catalogo →
                        </Link>
                    </motion.div>
                </motion.div>
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
                                <Link
                                    key={c.id}
                                    to={`/courses?category_id=${c.id}`}
                                    className="category-pill"
                                >
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
