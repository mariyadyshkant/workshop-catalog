import { useState, useEffect } from 'react'
import { useParams, Link } from 'react-router-dom'
import { Signal, Clock, Globe, MonitorPlay, MapPin, Users, Calendar, CalendarCheck, CircleDot, Ticket } from 'lucide-react'
import { api, imageUrl } from '../lib/api'

export function CourseDetail() {
    const { id } = useParams()
    const [course, setCourse] = useState(null)
    const [error, setError] = useState(false)
    const [showBooking, setShowBooking] = useState(false)

    useEffect(() => {
        api.get(`/courses/${id}`)
            .then(response => setCourse(response.data.data))
            .catch(error => {
                console.error(error)
                setError(true)
            })
    }, [id])

    useEffect(() => {
        if (!showBooking) return
        const t = setTimeout(() => setShowBooking(false), 3500)
        return () => clearTimeout(t)
    }, [showBooking])

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

    const info = [
        { icon: Signal, label: 'Livello', value: course.level?.name },
        { icon: Clock, label: 'Durata', value: `${course.duration_hours} ore` },
        { icon: Globe, label: 'Lingua', value: course.language },
        { icon: MonitorPlay, label: 'Modalità', value: course.delivery_mode },
        ...(course.delivery_mode === 'In presenza' && course.city
            ? [{ icon: MapPin, label: 'Città', value: course.city }]
            : []),
        ...(course.available_spots != null
            ? [{ icon: Users, label: 'Posti liberi', value: course.available_spots }]
            : []),
        { icon: Calendar, label: 'Inizio', value: course.start_date },
        ...(course.end_date ? [{ icon: CalendarCheck, label: 'Fine', value: course.end_date }] : []),
        { icon: CircleDot, label: 'Stato', value: course.status },
    ]

    const teacherInitial = (course.teacher?.name || '?').trim().charAt(0).toUpperCase()

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
                <div className="card border-0 rounded-4 mb-4 detail-info-card">
                    <div className="card-body p-4">
                        <div className="row g-4">
                            {info.map(({ icon: Icon, label, value }) => (
                                <div className="col-6 col-md-3" key={label}>
                                    <div className="detail-label">
                                        <Icon size={14} strokeWidth={2.5} />
                                        <span>{label}</span>
                                    </div>
                                    <span className="fw-semibold">{value}</span>
                                </div>
                            ))}
                        </div>
                    </div>
                </div>

                {/* Prenota (anteprima funzionalità futura) */}
                <div className="mb-4">
                    <button type="button" className="btn-prenota" onClick={() => setShowBooking(true)}>
                        <Ticket size={16} strokeWidth={2.5} />
                        Prenota
                    </button>
                    {showBooking && (
                        <div className="prenota-banner mt-3" role="status">
                            Prenotazioni disponibili a breve
                        </div>
                    )}
                </div>

                {/* Descrizione */}
                <h2 className="detail-section-title h5 fw-bold">Descrizione</h2>
                <p className="mb-4">{course.description}</p>

                {/* Requisiti */}
                <h2 className="detail-section-title h5 fw-bold">Requisiti</h2>
                <p className="mb-4">{course.requirements}</p>

                {/* Docente */}
                <h2 className="detail-section-title h5 fw-bold">Docente</h2>
                <div className="d-flex align-items-center gap-3">
                    <div className="teacher-avatar">{teacherInitial}</div>
                    <div>
                        <p className="fw-bold mb-0">{course.teacher?.name} {course.teacher?.surname}</p>
                        {course.teacher?.email && (
                            <p className="text-muted small mb-0">{course.teacher.email}</p>
                        )}
                    </div>
                </div>
                {course.teacher?.bio && <p className="mt-3 mb-0">{course.teacher.bio}</p>}
            </div>
        </div>
    )
}
