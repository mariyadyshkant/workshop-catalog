import { Link } from 'react-router-dom'

export function CourseCard({ course }) {
    return (
        <div className="card h-100 border-0 shadow-sm rounded-4">
            {course.image ? (
                <img 
                    src={`http://localhost:8000/storage/${course.image}`} 
                    className="card-img-top rounded-top-4" 
                    alt={course.title}
                    style={{ height: '180px', objectFit: 'cover' }}
                />
            ) : (
                <div className="bg-light rounded-top-4 d-flex align-items-center justify-content-center" style={{ height: '180px' }}>
                    <span className="text-muted fs-1">🖼️</span>
                </div>
            )}
            <div className="card-body">
                <span className="badge bg-primary-subtle text-primary mb-2">{course.category?.name}</span>
                <h5 className="card-title fw-bold">{course.title}</h5>
                <p className="card-text text-muted small">{course.description?.substring(0, 80)}...</p>
                <p className="mb-1 small">Livello: <strong>{course.level?.name}</strong></p>
                <p className="mb-1 small">Docente: <strong>{course.teacher?.name} {course.teacher?.surname}</strong></p>
                <p className="mb-0 small">Durata: <strong>{course.duration_hours}h</strong></p>
            </div>
            <div className="card-footer border-0 bg-white pb-3">
                <Link to={`/courses/${course.id}`} className="btn btn-sm btn-outline-primary w-100">
                    Scopri di più →
                </Link>
            </div>
        </div>
    )
}