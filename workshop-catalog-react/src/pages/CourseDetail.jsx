import { useState, useEffect } from 'react'
import { useParams, Link } from 'react-router-dom'
import { api, imageUrl } from '../lib/api'

export function CourseDetail() {
    const { id } = useParams()
    const [course, setCourse] = useState(null)
    const [error, setError] = useState(false)

    useEffect(() => {
        api.get(`/courses/${id}`)
            .then(response => setCourse(response.data.data))
            .catch(error => {
                console.error(error)
                setError(true)
            })
    }, [id])

    if (error) {
        return (
            <div className="container py-5 text-center">
                <p className="text-muted mb-3">Corso non trovato o errore di caricamento.</p>
                <Link to="/courses" className="btn btn-outline-primary btn-sm">Torna al catalogo</Link>
            </div>
        )
    }

    if (!course) {
        return (
            <div className="container py-5 text-center text-muted">
                Caricamento…
            </div>
        )
    }

    return (
        <div className="container py-4 py-md-5">
            <div className="mx-auto" style={{ maxWidth: '820px' }}>
                <div className="mb-4">
                    <Link
                        to="/courses"
                        className="text-decoration-none text-muted small d-inline-flex align-items-center gap-1"
                    >
                        ← Torna al catalogo
                    </Link>
                </div>

                {/* Titolo */}
                <span className="badge bg-primary-subtle text-primary mb-2">{course.category?.name}</span>
                <h1 className="fw-bold h2 mb-4">{course.title}</h1>

                {/* Immagine */}
                {course.image ? (
                    <img
                        src={imageUrl(course.image)}
                        alt={course.title}
                        className="w-100 rounded-4 mb-4"
                        style={{ maxHeight: '360px', objectFit: 'cover' }}
                    />
                ) : (
                    <div
                        className="bg-light rounded-4 d-flex align-items-center justify-content-center mb-4"
                        style={{ height: '240px' }}
                    >
                        <span className="text-muted fs-1">🖼️</span>
                    </div>
                )}

                {/* Info rapide */}
                <div className="card border-0 shadow-sm rounded-4 mb-4">
                    <div className="card-body p-4">
                        <div className="row g-3">
                            <div className="col-6 col-md-3">
                                <small className="text-muted text-uppercase fw-bold d-block">Livello</small>
                                <span className="fw-semibold">{course.level?.name}</span>
                            </div>
                            <div className="col-6 col-md-3">
                                <small className="text-muted text-uppercase fw-bold d-block">Durata</small>
                                <span className="fw-semibold">{course.duration_hours} ore</span>
                            </div>
                            <div className="col-6 col-md-3">
                                <small className="text-muted text-uppercase fw-bold d-block">Lingua</small>
                                <span className="fw-semibold">{course.language}</span>
                            </div>
                            <div className="col-6 col-md-3">
                                <small className="text-muted text-uppercase fw-bold d-block">Modalità</small>
                                <span className="fw-semibold">{course.delivery_mode}</span>
                            </div>
                            <div className="col-6 col-md-3">
                                <small className="text-muted text-uppercase fw-bold d-block">Inizio</small>
                                <span className="fw-semibold">{course.start_date}</span>
                            </div>
                            {course.end_date && (
                                <div className="col-6 col-md-3">
                                    <small className="text-muted text-uppercase fw-bold d-block">Fine</small>
                                    <span className="fw-semibold">{course.end_date}</span>
                                </div>
                            )}
                            <div className="col-6 col-md-3">
                                <small className="text-muted text-uppercase fw-bold d-block">Stato</small>
                                <span className="fw-semibold">{course.status}</span>
                            </div>
                        </div>
                    </div>
                </div>

                {/* Descrizione */}
                <h2 className="h5 fw-bold border-bottom pb-2 mb-3">Descrizione</h2>
                <p className="mb-4">{course.description}</p>

                {/* Requisiti */}
                <h2 className="h5 fw-bold border-bottom pb-2 mb-3">Requisiti</h2>
                <p className="mb-4">{course.requirements}</p>

                {/* Docente */}
                <h2 className="h5 fw-bold border-bottom pb-2 mb-3">Docente</h2>
                <p className="fw-bold mb-1">{course.teacher?.name} {course.teacher?.surname}</p>
                {course.teacher?.email && <p className="text-muted small mb-1">{course.teacher?.email}</p>}
                {course.teacher?.bio && <p className="mb-0">{course.teacher?.bio}</p>}
            </div>
        </div>
    )
}
