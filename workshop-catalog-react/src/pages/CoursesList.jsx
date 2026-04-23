import { useState, useEffect } from 'react'
import { CourseCard } from '../components/CourseCard'
import axios from 'axios'

export function CoursesList() {
    const [courses, setCourses] = useState([])
    const [loading, setLoading] = useState(true)

    useEffect(() => {
        axios.get('http://localhost:8000/api/courses')
            .then(response => setCourses(response.data))
            .catch(error => console.error(error))
            .finally(() => setLoading(false))
    }, [])

    if (loading) return <p>Caricamento...</p>

    return (
        <div>
            <h1>I nostri corsi</h1>
                <p className="page-header__subtitle">
                    Esplora il catalogo completo dei workshop disponibili.
                </p>
            {courses.length === 0 ? (
                <p>Nessun corso disponibile al momento.</p>
            ) : (
                <div className="row row-cols-1 row-cols-md-3 g-4">
                    {courses.map(course => (
                        <div className="col" key={course.id}>
                            <CourseCard course={course} />
                        </div>
                    ))}
                </div>
            )}
        </div>
    )
}
    