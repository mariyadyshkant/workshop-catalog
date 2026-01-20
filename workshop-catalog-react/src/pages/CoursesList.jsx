import { useState } from "react";
import { useEffect } from "react";
import axios from "axios";

export function CoursesList() {
    const [courses, setCourses] = useState([]);

    useEffect(() => {
        axios
            .get("http://localhost:8000/api/courses")
            .then((response) => {
                setCourses(response.data);
            })
            .catch((error) => {
                console.error("There was an error fetching the courses!", error);
            });
    }, []);
    return (
        <div>
            <h1>Courses List</h1>
            <ul>
                {courses.map((course) => (
                    <li key={course.id}>
                        {course.title} - {course.description}
                    </li>
                ))}
            </ul>
        </div>
    );
}