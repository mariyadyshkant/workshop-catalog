import { Link, Outlet } from "react-router-dom";

export function DefaultLayout() {
    return (
        <> 
            <nav className="navbar-bg navbar navbar-expand-lg navbar-light fixed-top">
                <div className="container">
                    <a className="navbar-brand fs-2 fw-bold text-light" href="#">Workshop Catalog</a>
                    <ul className="navbar-nav ms-auto">
                        <li className="nav-item">
                            <Link className="nav-link fs-4 text-light" to="/">Corsi</Link>
                        </li>
                    </ul>
                </div>
            </nav>
            <main className="container mt-4" style={{ paddingBottom: '80px', paddingTop: '70px' }}>
                    <Outlet />
            </main>
            <footer className="bg-dark text-white py-3 mt-5" style={{ position: 'fixed', bottom: 0, left: 0, right: 0 }}>
                <div className="container text-center">
                    <p className="mb-0 small">© {new Date().getFullYear()} Workshop Catalog</p>
                </div>
            </footer>
        </>
    );
}
