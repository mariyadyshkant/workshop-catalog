import { Link } from 'react-router-dom'

const STATUS_STYLES = {
    'In programma':   { bg: '#e8f5e9', color: '#2e7d32' },
    'In aggiornamento': { bg: '#fff8e1', color: '#f57f17' },
    'Cancellato':     { bg: '#fce4ec', color: '#c62828' },
}

const MODE_ICON = {
    'Online': '💻',
    'In presenza': '📍',
    'Misto': '🔀',
}

export function CourseCard({ course }) {
    const statusStyle = STATUS_STYLES[course.status] || { bg: '#f0f0f0', color: '#555' }

    return (
        <div className="course-card h-100">
            {course.image ? (
                <img
                    src={`${import.meta.env.VITE_API_URL.replace('/api', '')}/storage/${course.image}`}
                    className="course-card-img"
                    alt={course.title}
                />
            ) : (
                <div className="course-card-placeholder">
                    <span>{categoryEmoji(course.category?.name)}</span>
                </div>
            )}
            <div className="course-card-body">
                <div className="d-flex gap-2 flex-wrap mb-2">
                    <span className="badge-category">{course.category?.name}</span>
                    <span
                        className="badge-status"
                        style={{ background: statusStyle.bg, color: statusStyle.color }}
                    >
                        {course.status}
                    </span>
                </div>
                <h5 className="course-card-title">{course.title}</h5>
                <p className="course-card-desc">{course.description?.substring(0, 90)}...</p>

                <div className="course-card-meta">
                    <span title="Livello">📊 {course.level?.name}</span>
                    <span title="Durata">⏱ {course.duration_hours}h</span>
                    <span title="Modalità">{MODE_ICON[course.delivery_mode] || '🏫'} {course.delivery_mode}</span>
                </div>
            </div>
            <div className="course-card-footer">
                <small className="text-muted">
                    {course.teacher?.name} {course.teacher?.surname}
                </small>
                <Link to={`/courses/${course.id}`} className="btn-card-detail">
                    Scopri →
                </Link>
            </div>
        </div>
    )
}

function categoryEmoji(name) {
    const map = {
        'Programmazione': '💻',
        'Fotografia': '📷',
        'Cucina': '🍝',
        'Giardinaggio': '🌱',
        'Arte e Disegno': '🎨',
        'Teatro': '🎭',
        'Produttività': '⚡',
        'Fai Da Te': '🔨',
    }
    return map[name] || '📚'
}
