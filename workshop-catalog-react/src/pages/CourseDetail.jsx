import { useState, useEffect } from 'react'
import { useParams, Link } from 'react-router-dom'
import axios from 'axios'

export function CourseDetail() {
    const { id } = useParams()
    const [course, setCourse] = useState(null)
    const [error, setError] = useState(false)

    useEffect(() => {
        axios.get(`${import.meta.env.VITE_API_URL}/courses/${id}`)
            .then(response => setCourse(response.data.data))
            .catch(error => {
                console.error(error)
                setError(true)
            })
    }, [id])

    if (error) return <p>Corso non trovato o errore di caricamento.</p>
    if (!course) return <p>Caricamento...</p>

    return (
        <div>
            <Link to="/" className="text-muted fs-4 text-decoration-none mb-3 d-inline-block">
                ← Torna al catalogo
            </Link>

            <div className="d-flex align-items-center gap-2 mb-3">
                <h1 className="fw-bold mb-0">{course.title}</h1>
                <span className="badge bg-primary-subtle text-primary">{course.category?.name}</span>
            </div>

            {/* Immagine */}
            {course.image ? (
                <img
                    src={`${import.meta.env.VITE_API_URL.replace('/api', '')}/storage/${course.image}`}
                    alt={course.title}
                    className="w-100 rounded-4 mb-4"
                    style={{ maxHeight: '350px', objectFit: 'cover' }}
                />
            ) : (
                <div className="bg-light rounded-4 d-flex align-items-center justify-content-center mb-4" style={{ height: '250px' }}>
                    <span className="text-muted fs-1">🖼️</span>
                </div>
            )}

            {/* Info rapide */}
            <div className="card border-0 shadow-sm rounded-4 mb-4">
                <div className="card-body">
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
            <h5 className="fw-bold border-bottom pb-2 mb-3">Descrizione</h5>
            <p className="mb-4">{course.description}</p>

            {/* Requisiti */}
            <h5 className="fw-bold border-bottom pb-2 mb-3">Requisiti</h5>
            <p className="mb-4">{course.requirements}</p>

            {/* Docente */}
            <h5 className="fw-bold border-bottom pb-2 mb-3">Docente</h5>
            <p className="fw-bold mb-1">{course.teacher?.name} {course.teacher?.surname}</p>
            {course.teacher?.email && <p className="text-muted small mb-1">{course.teacher?.email}</p>}
            {course.teacher?.bio && <p>{course.teacher?.bio}</p>}
        </div>
    )
}