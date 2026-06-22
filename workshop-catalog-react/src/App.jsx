import { BrowserRouter, Routes, Route } from 'react-router-dom'
import { DefaultLayout } from './layouts/DefaultLayout'
import { CoursesList } from './pages/CoursesList'
import { CourseDetail } from './pages/CourseDetail'

function App() {
  return (
    <BrowserRouter basename={import.meta.env.BASE_URL}>
      <Routes>
        <Route element={<DefaultLayout />}>
          <Route path="/" element={<CoursesList />} />
          <Route path="/courses/:id" element={<CourseDetail />} />
        </Route>
      </Routes>
    </BrowserRouter>
  )
}

export default App